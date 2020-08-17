@extends('layouts.' . $product->gender)

@section('title', $product->product_name)

@section('product_content')
<product-show :product={{ $product }} route={{ route('purchase_cart.store') }}></product-show>

@endsection