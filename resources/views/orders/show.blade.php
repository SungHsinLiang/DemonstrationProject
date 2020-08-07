@extends('layouts.layout')

@section('title', '訂單詳細')

@section('main_content')
<orders-show order_lists={{ $order_lists }} order_route="{{ route('orders.index')}}"></orders-show>
@endsection