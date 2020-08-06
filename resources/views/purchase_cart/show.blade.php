@extends('layouts.layout')

@section('title', 'Purchase Cart')

@section('main_content')


<purchase-cart-show :purchase_lists="{{ $purchase_lists }}" purchase_cart_route="{{ route('purchase_cart.index') }}"
  product_route="{{ route('product.index')}}" order_route="{{ route("order.store")}}">
</purchase-cart-show>

@endsection