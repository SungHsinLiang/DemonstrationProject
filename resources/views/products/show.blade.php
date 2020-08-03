@if ($product->gender == 'men')
@extends('layouts.men')
@endif

@section('title', $product->product_name)

@section('product_content')

<product-show :product={{ $product }} route={{ route('purchase_cart.store') }}></product-show>

@endsection