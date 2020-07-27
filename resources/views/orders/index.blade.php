@extends('layouts.layout')

@section('title', '訂單查詢')

@section('main_content')
    
<orders-index orders_index_route="{{ route('orders.index') }}"></orders-index>

@endsection