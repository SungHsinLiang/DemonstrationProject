@extends('layouts.layout')

@section('title', 'Home page')

@section('main_content')
<div class="container text-center my-3">
  <h1>This website is for practicing</h1>
  <h1>本網站為練習使用網站</h1>
</div>

<home-carousel carousels="{{ $carousels }}"></home-carousel>

<div class="d-flex justify-content-around">
  <div class="container">
    <div class="row">
      @foreach ($products as $product)
      <div class="col-4 p-0 my-4 text-center">
        <a href="{{ url("/product/{$product->id}") }}"><img src="{{ json_decode($product->imgs)->img_main_thunbnail }}"
            alt="{{ $product->product_name }}" /></a>
        <pre class="mr-0 my-1">Product Id : {{$product->id}}</pre>
        <p class="mr-0 my-1">{{$product->product_name}}</p>
        <p class="mr-0 my-1">NT$ : {{$product->price}}</p>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection