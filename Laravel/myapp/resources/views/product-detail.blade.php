@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/product-detail.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
    <button class="edit">Edit</button>
    <section class="detail-wrapper">
        <img  src="{{ asset('assets/products/' . json_decode($product->image_path)[0]) }}"
        alt="{{ $product->name }}" />

        <div class="product-information">
            <p class="title">{{ $product->name }}</p>
            <p class="price">{{ number_format($product->price, 2, ',', ' ') }} €</p>
            <p class="description">{{ $product->description }}</p>
        </div>

        <div class="wrapper-wrapper">
            <form action="{{ route('product.quantity.update', $product->id) }}" method="POST" class="product-amount">
                @csrf
                <button type="submit" name="quantity" value="{{ max(1, $quantity - 1) }}">-</button>
                <div>{{ $quantity }}</div>
                <button type="submit" name="quantity" value="{{ $quantity + 1 }}">+</button>
            </form>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="quantity" value="{{ $quantity }}" />
                <button type="submit" name="add" value="true" class="add-to-cart-button">Add to cart</button>
            </form>
        </div>
    </section>
</main>
@endsection

