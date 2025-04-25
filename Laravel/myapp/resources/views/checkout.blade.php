@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/checkout.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
    @php
        $cartTotal = 0;
    @endphp

    @forelse ($products as $product)
    @php
        $productTotal = $product->price * $product->pivot->quantity;
        $cartTotal += $productTotal;
    @endphp

    <section class="product-wrapper">
        <img class="product-image"
             src="{{ asset('assets/products/' . json_decode($product->image_path)[0]) }}"
             alt="{{ $product->name }}" />

            <h2 class="product-name">
                <a href="{{ route('product.detail', $product->id) }}">
                    {{ $product->name }}
                </a>
            </h2>

        <form action="{{ route('cart.update', $product->id) }}" method="POST" class="product-amount">
            @csrf
            <button type="submit" name="quantity" value="{{ $product->pivot->quantity - 1 }}">-</button>
            <div>{{ $product->pivot->quantity }}</div>
            <button type="submit" name="quantity" value="{{ $product->pivot->quantity + 1 }}">+</button>
        </form>

        <form action="{{ route('cart.remove', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="remove-button">Remove</button>
        </form>

        <p class="price">{{ number_format($productTotal, 2, ',', ' ') }}€</p>
    </section>
    @empty
        <p>No items in your cart.</p>
    @endforelse

    @if ($products->count())
    <section class="cart-total" style="margin-top: 20px; text-align: right;">
        <h3>Total: {{ number_format($cartTotal, 2, ',', ' ') }}€</h3>
    </section>

    <section class="form">
        <form action="{{ route('checkout.process') }}" method="POST" class="form-form">
            @csrf

            <div class="pesonal-information">
                <h2>Personal information</h2>
                <input type="text" name="first_name" placeholder="First name"
                    value="{{ old('first_name', $user->first_name ?? '') }}" required />
                <input type="text" name="last_name" placeholder="Last name"
                    value="{{ old('last_name', $user->last_name ?? '') }}" required />
                <input type="email" name="email" placeholder="Email"
                    value="{{ old('email', $user->email ?? '') }}" required />
                <input type="tel" name="phone_number" placeholder="Phone number"
                    value="{{ old('phone_number', $user->phone_number ?? '') }}" required />
            </div>

            <div class="delivery-information">
                <h2>Delivery/Billing information</h2>
                <input type="text" name="street" placeholder="Street"
                    value="{{ old('street') }}" required />
                <input type="text" name="city" placeholder="City"
                    value="{{ old('city') }}" required />
                <input type="text" name="postalcode" placeholder="Postal code"
                    value="{{ old('postalcode') }}" required />
            </div>

            <div class="payment-method">
                <h2>Payment method</h2>
                @foreach(['card', 'cash', 'apple pay'] as $method)
                    <div class="checkbox-wrapper">
                        <input type="radio" name="payment_method" value="{{ $method }}"
                            {{ old('payment_method') == $method ? 'checked' : '' }} required />
                        <p>{{ ucfirst($method) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="delivery-method">
                <h2>Delivery method</h2>
                @foreach(['address', 'personal collection'] as $method)
                    <div class="checkbox-wrapper">
                        <input type="radio" name="delivery_method" value="{{ $method }}"
                            {{ old('delivery_method') == $method ? 'checked' : '' }} required />
                        <p>{{ ucfirst($method) }}</p>
                    </div>
                @endforeach
            </div>

            <button class="submit-button" type="submit">
                Confirm information
            </button>
        </form>
    </section>
    @endif
    @if (session('success'))
        <div class="popup-overlay">
            <div class="popup">
                <h2>Order Successful!</h2>
                <p>{{ session('success') }}</p>
                <p>You will be redirected to the homepage in <span id="countdown">5</span> seconds.</p>
                <p><a href="{{ url('/') }}">Go now</a></p>
            </div>
        </div>

        <script>
            let seconds = 5;
            const countdown = document.getElementById('countdown');
            const interval = setInterval(() => {
                seconds--;
                countdown.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(interval);
                    window.location.href = "{{ url('/') }}";
                }
            }, 1000);
        </script>
    @endif

</main>
@endsection
