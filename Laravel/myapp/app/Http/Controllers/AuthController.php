<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $this->mergeGuestCart(Auth::user(), $request);

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $this->mergeGuestCart($user, $request);

        return redirect('/')->with('success', 'Account created and logged in.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function mergeGuestCart(User $user, Request $request) {
        $guestCart = $request->session()->get('guest_cart', []);

        if (!empty($guestCart)) {
            $cart = $user->cart ?? $user->cart()->create();

            foreach ($guestCart as $productId => $quantity) {
                $existing = $cart->products()->where('product_id', $productId)->first();

                if ($existing) {
                    $cart->products()->updateExistingPivot($productId, [
                        'quantity' => $existing->pivot->quantity + $quantity
                    ]);
                } else {
                    $cart->products()->attach($productId, ['quantity' => $quantity]);
                }
            }

            $request->session()->forget('guest_cart');
        }
    }
}
