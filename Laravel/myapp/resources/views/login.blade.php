@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      @if ($errors->any())
          <div class="error-box">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <section class="login-form">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit">Login</button>
        </form>

        <p class="signup-redirect"><a href="{{ asset('register.html">Don’t have an account? Sign up!</a></p>
      </section>
    </main>
@endsection