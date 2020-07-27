@extends('layouts.men')

@section('title', 'Men')

@section('product_content')

<h2 class="font-weight-bold pl-4 pt-4">Men</h2>

<div class="d-flex justify-content-around">
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-3 p-0 m-4 text-center">
                <a href="{{ url("/product/{$product->id}") }}"><img src="{{ $product->img_main_thumbnail }}"
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