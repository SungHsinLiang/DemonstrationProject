@extends('layouts.men')

@section('title', $products->count() > 0 ? 'Men-' . $products[0]->category . '-' . $products[0]->style : 'Men')

@if ($products->count() == 0)

@section('product_content')

<div class="d-flex justify-content-around">
  <div class="container">
    <div class="row">
      <h1>此類別無商品</h1>
    </div>
  </div>
</div>

@else

@section('product_content')

<h2 class="font-weight-bold pl-4 pt-4">{{ $products[0]->style }}</h2>
<div class="d-flex justify-content-around">
  <div class="container">
    <div class="row">
      @foreach ($products as $product)
      <div class="col-3 p-0 m-4 text-center">
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

@endif

@endsection