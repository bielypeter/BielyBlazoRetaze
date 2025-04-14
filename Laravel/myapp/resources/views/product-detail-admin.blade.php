@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/product-detail.css') }}">
@endpush

@extends('layout')

@section('content')
<main class="main-content">
      <button class="edit">Edit</button>
      <section class="detail-wrapper">
        <img src="{{ asset('assets/jeffrey-grospe-yDouV_MSzOQ-unsplash.jpg') }}" alt="Image of a keyboard"/>
        <div class="product-information">
          <p class="title">Keychrom red</p>
          <p class="price">23,72 €</p>
          <p class="description">
            orem ipsum dolor sit amet, consectetur adipiscing elit. 
            In sed tortor luctus nisl laoreet facilisis. 
            Duis sed fringilla elit. Praesent mollis nunc nunc, id 
            eleifend dui congue sed. Ut nec bibendum enim. Proin 
            ullamcorper nibh rutrum nisl auctor faucibus. Aliquam sit 
            amet purus in neque eleifend sollicitudin. Ut vel ipsum ac 
            sem dignissim mollis a nec eros. Nullam felis augue, molestie 
            eget turpis eget, egestas ultricies erat. Maecenas nec velit 
            id ex ornare volutpat dignissim ac neque. In gravida aliquam cursus.
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