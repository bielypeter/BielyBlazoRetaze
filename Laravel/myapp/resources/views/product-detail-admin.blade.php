@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/product-detail.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <button class="edit">Edit</button>
      <section class="detail-wrapper">
        <img src="{{ asset('assets/products/' . json_decode($product->image_path)[0]) }}" alt="{{ $product->name }}"/>
        <div class="product-information">
            <p class="title">{{ $product->name }}</p>
            <p class="price">{{ number_format($product->price, 2, ',', ' ') }} €</p>
            <p class="description">
                {{ $product->description }}
            </p>
        </div>
        <div class="wrapper-wrapper">
            <div class="product-amount">
                <button>-</button>
                <div>1</div>
                <button>+</button>
            </div>
            <button class="add-to-cart-button">add to cart</button>
        </div>
    </section>
    </main>
@endsection