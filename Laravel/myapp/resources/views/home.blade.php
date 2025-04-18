@extends('layout')

@section('content')
<main class="main-content">
      <section class="banner-wrapper">
        <picture>
          <source srcset="{{ asset('assets/DisplayMechanicalkeybo-970x250-px.png') }}" media="(min-width: 768px)">
          <img src="{{ asset('assets/DisplayMechanicalkeybo-mobile.png') }}" class="banner" alt="Banner" />
        </picture>
      </section>
      <section class="images">
      @foreach ($products as $product)
        <a href="{{ url('/product-detail/' . $product->id) }}">
          <article class="product">
              <img src="{{ asset('assets/products/' . json_decode($product->image_path)[0]) }}" alt="{{ $product->name }}">
              <span class="info-wrapper">
                <span>
                  <h3>{{ $product->name }}</h3>
                  <p>{{ $product->description }}</p>
                </span>
                <p>{{ $product->price }} €</p>
              </span>
          </article>
        </a>
      @endforeach
    </section>
  </main>
@endsection