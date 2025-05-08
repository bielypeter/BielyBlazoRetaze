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
        
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 2rem;
            overflow-y: auto;
        }

        .modal {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.3);
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }


        .modal .close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal button.danger {
            background-color: #e74c3c;
            color: white;
        }

        .admin-form {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .admin-form label {
            font-weight: bold;
            margin-bottom: 0.25rem;
            color: #333;
        }

        .admin-form input,
        .admin-form textarea {
            padding: 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            font-size: 1rem;
            width: 100%;
        }

        .admin-form textarea {
            min-height: 100px;
            resize: vertical;
        }

        .save-button {
            margin-top: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .save-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            margin-top: 1rem;
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .delete-button:disabled {
            background-color: #ccc;
            color: #666;
            border: none;
            cursor: not-allowed;
        }

        .admin-image-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .image-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .image-item img {
            width: 100px;
            height: auto;
            border-radius: 0.5rem;
            object-fit: cover;
        }

    </style>
@endpush

@extends('layout')

@section('content')
<main class="main-content">
    @auth
        @if (Auth::user()->role === 'admin')
            <button class="edit" onclick="document.getElementById('editModal').style.display = 'flex'">Edit</button>

            <div id="editModal" class="modal-overlay">
                <div class="modal">
                    <button onclick="document.getElementById('editModal').style.display = 'none'" class="close">&times;</button>
                    <h2>Edit Product</h2>

                    <form method="POST" action="{{ route('product.update', $product->id) }}" class="admin-form">
                        @csrf
                        @method('PUT')

                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{ $product->name }}" required />

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required>{{ $product->description }}</textarea>

                        <label for="price">Price (€):</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}" step="0.01" required />
                        
                        <button type="submit" class="save-button">Save Changes</button>
                    </form>
                    <h3>Images</h3>
                    <div class="admin-image-grid">
                        @php $images = json_decode($product->image_path); @endphp
                        @foreach ($images as $index => $image)
                            <div class="image-item">
                                <img src="{{ asset('assets/products/' . $image) }}" alt="Image {{ $index }}" />
                                
                                @if (count($images) > 1)
                                    <form method="POST" action="{{ route('product.image.delete', [$product->id, $index]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button">Remove</button>
                                    </form>
                                @else
                                    <button class="delete-button" disabled style="opacity: 0.5; cursor: not-allowed;">
                                        Cannot remove last image
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <form method="POST" action="{{ route('product.image.upload', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <label for="new_images">Upload New Images:</label>
                        <input type="file" name="new_images[]" multiple accept="image/*" required />
                        <button type="submit" class="save-button">Upload</button>
                    </form>

                    <form method="POST" action="{{ route('product.destroy', $product->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Delete Product</button>
                    </form>

                </div>
            </div>
        @endif
    @endauth

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
