@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <section class="login-form">
        <h2>Login</h2>
        <form>
            <input type="email" placeholder="Email" required>
            <input type="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p class="signup-redirect"><a href="{{ asset('register.html">Don’t have an account? Sign up!</a></p>
      </section>
    </main>
@endsection