@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/category.css') }}">
@endpush


@extends('layout')

@section('content')
<main class="main-content">
      <section>
        <select class="select" id="sortBy" name="sortBy">
          <option value="" disabled selected>Sort by</option>
          <option value="apple">Name</option>
          <option value="banana">Price</option>
          <option value="orange">Date</option>
        </select>
      </section>
      <section class="products-wrapper">
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/bin-jaleel-almanza-VKI8S_O-pYg-unsplash.jpg') }}" alt="Image of a keyboard"/>
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
            <img src="{{ asset('assets/jan-loyde-cabrera-4GzqVNX0TCQ-unsplash.jpg') }}" alt="Image of a keyboard"/>
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
            <img src="{{ asset('assets/jan-loyde-cabrera-MJ7FfTP2D5Y-unsplash.jpg') }}" alt="Image of a keyboard"/>
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
            <img src="{{ asset('assets/jan-loyde-cabrera-p5rgceFiOH0-unsplash.jpg') }}" alt="Image of a keyboard"/>
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
            <img src="{{ asset('assets/jan-loyde-cabrera-Z9W0zM9BBQw-unsplash.jpg') }}" alt="Image of a keyboard"/>
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
            <img src="{{ asset('assets/theex-studio-ipD2CGhx7iI-unsplash.jpg') }}" alt="Image of a keyboard"/>
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
            <img src="{{ asset('assets/nikita-JzqqSAXYBL8-unsplash.jpg') }}" alt="Image of a keyboard"/>
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