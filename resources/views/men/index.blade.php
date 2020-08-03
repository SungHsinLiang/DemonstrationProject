@extends('layouts.men')

@section('title', 'Men')

@section('product_content')

<div class="container">
  <img src="/images/men_home_page.jpg" alt="">
</div>

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