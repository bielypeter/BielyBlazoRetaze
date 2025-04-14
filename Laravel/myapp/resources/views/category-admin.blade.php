@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/category.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <section class="select-wrapper">
        <select class="select" id="sortBy" name="sortBy">
          <option value="" disabled selected>Sort by</option>
          <option value="apple">Name</option>
          <option value="banana">Price</option>
          <option value="orange">Date</option>
        </select>
        <button class="add-button">Add</button>
      </section>
      <section class="products-wrapper">
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard" />
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/ketyboard3.png') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>Price</p>
            </span>
          </article>
        </a>
      </section>
      <section class="pages">
        <button class="gt-lt">&lt;</button>
        <div> 
          <button class="page-number"> 
            1
          </button >
          <button class="page-number"> 
            2
          </button>
          <button class="page-number"> 
            3
          </button>
        </div>
        <button class="gt-lt">&gt;</button>

      </section>
    </main>
@endsection