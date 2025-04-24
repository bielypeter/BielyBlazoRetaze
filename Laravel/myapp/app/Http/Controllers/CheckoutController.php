<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Address;

class CheckoutController extends Controller
{
    public function index()
    {
        $products = $this->getCartProducts();
        $user = Auth::user();

        return view('checkout', compact('products', 'user'));
    }

    public function addToCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity') ?? $request->input('final_quantity', 1);
        $quantity = max((int) $quantity, 1);
        session(['last_quantity' => $quantity]);

        if (Auth::check()) {
            $cart = Auth::user()->cart ?? Auth::user()->cart()->create();
            $existing = $cart->products()->where('product_id', $productId)->first();

            if ($existing) {
                $cart->products()->updateExistingPivot($productId, [
                    'quantity' => $existing->pivot->quantity + $quantity
                ]);
            } else {
                $cart->products()->attach($productId, ['quantity' => $quantity]);
            }
        } else {
            $guestCart = session()->get('guest_cart', []);
            $guestCart[$productId] = ($guestCart[$productId] ?? 0) + $quantity;
            session()->put('guest_cart', $guestCart);
        }

        session()->forget('last_quantity');

        return redirect()->route('checkout');
    }

    public function updateQuantity(Request $request, $productId)
    {
        $quantity = max((int) $request->input('quantity', 1), 0);

        if (Auth::check()) {
            $cart = Auth::user()->cart ?? Auth::user()->cart()->create();
            if ($quantity === 0) {
                $cart->products()->detach($productId);
            } else {
                $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
            }
        } else {
            $guestCart = session()->get('guest_cart', []);
            if ($quantity === 0) {
                unset($guestCart[$productId]);
            } else {
                $guestCart[$productId] = $quantity;
            }
            session()->put('guest_cart', $guestCart);
        }

        return redirect()->route('checkout');
    }

    public function removeFromCart($productId)
    {
        if (Auth::check()) {
            $cart = Auth::user()->cart;
            $cart?->products()->detach($productId);
        } else {
            $guestCart = session()->get('guest_cart', []);
            unset($guestCart[$productId]);
            session()->put('guest_cart', $guestCart);
        }

        return redirect()->route('checkout');
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'postalcode' => 'required|numeric',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
        ]);

        $address = Address::create([
            'street' => $validated['street'],
            'city' => $validated['city'],
            'postalcode' => $validated['postalcode'],
        ]);

        $products = $this->getCartProducts();

        if ($products->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $total = $products->sum(fn($p) => $p->price * $p->pivot->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'address_id' => $address->id,
            'total_price' => $total,
            'delivery_method' => $validated['delivery_method'],
            'payment_method' => $validated['payment_method'],
        ]);

        foreach ($products as $product) {
            $order->products()->attach($product->id, [
                'quantity' => $product->pivot->quantity,
            ]);
        }

        if (Auth::check()) {
            $cart = Auth::user()->cart;
            $cart?->products()->detach();
            $cart?->delete();
        } else {
            session()->forget('guest_cart');
        }

        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }

    private function getCartProducts()
    {
        if (Auth::check()) {
            return Auth::user()->cart?->products()->withPivot('quantity')->get() ?? collect();
        }

        $guestCart = session()->get('guest_cart', []);
        $products = collect();

        foreach ($guestCart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $product->pivot = (object)['quantity' => $quantity];
                $products->push($product);
            }
        }

        return $products;
    }
}
