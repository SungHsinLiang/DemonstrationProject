@extends('layouts.layout')

@section('title', 'Purchase Cart')

@section('main_content')


<show-purchase-list :purchase_lists="{{ $purchase_lists }}" purchase_cart_route="{{ route('purchase_cart.index') }}"
    product_route="{{ route('product.index')}}" >
</show-purchase-list>

@endsection