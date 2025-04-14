@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <section class="register-form">
        <h2>Register</h2>
        <form>
          <input type="text" placeholder="First Name" required>
          <input type="text" placeholder="Last Name" required>
          <input type="email" placeholder="Email" required>
          <input type="password" placeholder="Password" required>
          <input type="tel" placeholder="Phone number" required>
          <button type="submit">Register</button>
        </form>
      </section>
    </main>
@endsection