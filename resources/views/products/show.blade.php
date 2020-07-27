@if ($product->gender == 'men')
@extends('layouts.men')
@endif

@section('title', $product->product_name)

@section('product_content')

<product-particulars :product={{ $product }} route={{ route('purchase_cart.store') }}></product-particulars>

@endsection