@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/product-detail.css') }}">
    <style>
        .gallery-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .gallery-overlay.active {
            display: flex;
        }

        .gallery-content {
            background: #fff;
            padding: 1rem;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
            border-radius: 8px;
            position: relative;
        }

        .gallery-content img {
            max-width: 100%;
            max-height: 60vh;
        }

        .gallery-thumbnails {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .gallery-thumbnails img {
            width: 80px;
            height: auto;
            cursor: pointer;
            border-radius: 4px;
        }

        .gallery-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
        }
    </style>
@endpush

@extends('layout')

@section('content')
<main class="main-content">
    <section class="detail-wrapper">
        <img src="{{ asset('assets/products/' . json_decode($product->image_path)[0]) }}"
             alt="{{ $product->name }}"
             style="cursor:pointer"
             onclick="openGallery()" />

        <div class="product-information">
            <p class="title">{{ $product->name }}</p>
            <p class="price">{{ number_format($product->price, 2, ',', ' ') }} €</p>
            <p class="description">{{ $product->description }}</p>
        </div>

        <div class="wrapper-wrapper">
            <form action="{{ route('cart.add', $product->id) }}" method="POST"  class="wrapper-wrapper">
                @csrf
                <div class="product-amount">
                    <button type="button" onclick="changeQuantity(-1)">-</button>
                    <div id="quantity-display">1</div>
                    <input type="hidden" name="quantity" id="quantity" value="1" />
                    <button type="button" onclick="changeQuantity(1)">+</button>
                </div>

                <button type="submit" name="add" value="true" class="add-to-cart-button">Add to cart</button>
            </form>
        </div>
    </section>

    <div class="gallery-overlay" id="gallery">
        <div class="gallery-content">
            <button class="gallery-close" onclick="closeGallery()">×</button>
            <img id="main-gallery-image"
                 src="{{ asset('assets/products/' . json_decode($product->image_path)[0]) }}"
                 alt="Gallery image" />

            <div class="gallery-thumbnails">
                @foreach (json_decode($product->image_path) as $image)
                    <img src="{{ asset('assets/products/' . $image) }}"
                        onclick="switchGalleryImage(this)"
                        alt="Gallery thumbnail" />
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function changeQuantity(delta) {
            const input = document.getElementById('quantity');
            const display = document.getElementById('quantity-display');
            let quantity = parseInt(input.value) || 1;

            quantity = Math.max(1, quantity + delta);
            input.value = quantity;
            display.textContent = quantity;
        }

        function openGallery() {
            document.getElementById('gallery').classList.add('active');
        }

        function closeGallery() {
            document.getElementById('gallery').classList.remove('active');
        }

        function switchGalleryImage(img) {
            document.getElementById('main-gallery-image').src = img.src;
        }
    </script>
</main>
@endsection
