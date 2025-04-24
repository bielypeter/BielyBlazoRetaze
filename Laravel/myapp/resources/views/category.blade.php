@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/category.css') }}">
@endpush


@extends('layout')

@section('content')
<main class="main-content">
  <h2>{{ $category->name }}</h2>
  <form method="GET" action="{{ url()->current() }}">
    {{-- Keep existing filters in hidden inputs, so when we change sort, it doesnt wipe our filters. --}}
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
      
    </main>
@endsection