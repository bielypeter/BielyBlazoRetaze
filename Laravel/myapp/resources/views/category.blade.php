@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/category.css') }}">
    <style>
      .modal-overlay {
          position: fixed;
          inset: 0;
          background: rgba(0, 0, 0, 0.7);
          display: none;
          justify-content: center;
          align-items: center;
          z-index: 1000;
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
          position: relative;
          display: flex;
          flex-direction: column;
          gap: 1rem;
      }

      .close {
          position: absolute;
          top: 1rem;
          right: 1rem;
          background: none;
          border: none;
          font-size: 1.5rem;
          cursor: pointer;
      }

      .admin-form {
          display: flex;
          flex-direction: column;
          gap: 1rem;
      }

      .admin-form label {
          font-weight: bold;
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

      .admin-form select {
        padding: 0.5rem;
        border-radius: 0.5rem;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 100%;
      }
    </style>
@endpush


@extends('layout')

@section('content')
<main class="main-content">
  <h2>{{ $category->name }}</h2>
  <form method="GET" action="{{ url()->current() }}">
    @foreach(request()->except('sort') as $key => $value)
        @if(is_array($value))
            @foreach($value as $v)
                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach

    <section>
      <select class="select" name="sort" onchange="this.form.submit()">
        <option value="" disabled {{ request('sort') ? '' : 'selected' }}>Sort by</option>
        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price ↑</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price ↓</option>
      </select>
      @auth
          @if (Auth::user()->role === 'admin' && isset($category) && isset($category->id))
            <button type="button" class="add-button" onclick="document.getElementById('addProductModal').style.display = 'flex'">Add Product</button>
          @endif
      @endauth
    </section>
  </form>
      <section class="products-wrapper">
    @forelse ($products as $product)
      <a href="{{ route('product.detail', $product->id) }}" class="product-link">
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
  
    @empty
        <p>No products in this category.</p>
    @endforelse
      </section>
      <div class="pagination-wrapper">
        {{ $products->links('vendor.pagination.custom_pagination') }}
      </div>
      @if (isset($category) && isset($category->id))
      <div id="addProductModal" class="modal-overlay" style="display: none;">
        <div class="modal">
            <button type="button" onclick="document.getElementById('addProductModal').style.display = 'none'" class="close">&times;</button>
            <h2>Add New Product</h2>

            <form method="POST" action="{{ route('product.store', ['category' => $category->id]) }}" enctype="multipart/form-data" class="admin-form">
                @csrf
                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Reopen the modal if there was an error --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            document.getElementById('addProductModal').style.display = 'flex';
                        });
                    </script>
                @endif

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="price">Price (€):</label>
                <input type="number" id="price" name="price" step="0.01" required>
                
                <label for="brand">Brand:</label>
                <select name="brand" id="brand">
                    <option value="">Select brand (optional)</option>
                    @foreach (['Razer', 'Trust', 'HyperX', 'Keychron'] as $brand)
                        <option value="{{ $brand }}" {{ old('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>

                <label for="color">Color:</label>
                <select name="color" id="color">
                    <option value="">Select color (optional)</option>
                    @foreach (['Red', 'Green', 'Turquise', 'Cyan'] as $color)
                        <option value="{{ $color }}" {{ old('color') == $color ? 'selected' : '' }}>{{ $color }}</option>
                    @endforeach
                </select>

                <label for="images">Upload Images (minimum 2):</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*" required>

                <button type="submit" class="save-button">Create Product</button>
            </form>
        </div>
        @endif
    </div>


</main>
@endsection