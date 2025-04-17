@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <section class="register-form">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <input type="text" name="first_name" placeholder="First Name" required>
          <input type="text" name="last_name" placeholder="Last Name" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="text" name="phone_number" placeholder="Phone Number">
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
          <button type="submit">Register</button>
        </form>
      </section>
    </main>
@endsection