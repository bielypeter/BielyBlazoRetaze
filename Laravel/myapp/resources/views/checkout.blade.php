@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/checkout.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <section class="product-wrapper">
        <img
          class="product-image"
          src="{{ asset('assets/akkogear-eu-MzyJyxTeebU-unsplash.jpg') }}" alt="Image of a keyboard"
        />
        <h2 class="product-name">Name of the product</h2>
        <div class="product-amount">
          <button>-</button>
          <div>1</div>
          <button>+</button>
        </div>
        <p class="price">77,66€</p>
      </section>
      <section class="form">
        <form class="form-form">
          <div class="pesonal-information">
            <h2>Personal information</h2>
            <input type="text" placeholder="First name" required />
            <input type="text" placeholder="Last name" required />
            <input type="email" placeholder="Email" required />
            <input type="tel" placeholder="Phone number" required />
          </div>
          <div class="delivery-information">
            <h2>Delivery/Billing information</h2>
            <input type="text" placeholder="Street" required />
            <input type="text" placeholder="City" required />
            <input type="number" placeholder="Postal code" required />
          </div>
          <div class="payment-method">
            <h2>Payment method</h2>
            <div class="checkbox-wrapper">
              <input type="checkbox" placeholder="Card" required />
              <p>Card</p>
            </div>
            <div class="checkbox-wrapper">
              <input type="checkbox" placeholder="Cash" required />
              <p>Cash</p>
            </div>
            <div class="checkbox-wrapper">
              <input type="checkbox" placeholder="Apple pay" required />
              <p>Apple pay</p>
            </div>
          </div>
          <div class="delivery-method">
            <h2>Delivery method</h2>
            <div class="checkbox-wrapper">
              <input type="checkbox" placeholder="Address" required />
              <p>Address</p>
            </div>
            <div class="checkbox-wrapper">
              <input
                type="checkbox"
                placeholder="Personal collection"
                required
              />
              <p>Personal collection</p>
            </div>
          </div>
          <button class="submit-button" type="submit">
            Confirm information
          </button>
        </form>
      </section>
    </main>
@endsection