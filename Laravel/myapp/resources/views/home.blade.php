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
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/jan-loyde-cabrera-dWIFnxAQ7_w-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/theex-studio-hY-RCV_dAQA-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
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
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/jeffrey-grospe-yDouV_MSzOQ-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
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
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/jan-loyde-cabrera-6ddsNS2dybg-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
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
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/bin-jaleel-almanza-VKI8S_O-pYg-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/akkogear-eu-MzyJyxTeebU-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/jan-loyde-cabrera-J3A5rtfHu0M-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
            </span>
          </article>
        </a>
        <a href="{{ url('/product-detail') }}">
          <article class="product">
            <img src="{{ asset('assets/jan-loyde-cabrera-RSOxS_h0XCk-unsplash.jpg') }}" alt="Image of a keyboard"/>
            <span class="info-wrapper">
              <span>
                <h3>Title</h3>
                <p>Description</p>
              </span>
              <p>99€</p>
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
              <p>99€</p>
            </span>
          </article>
        </a>
      </section>
    </main>
@endsection