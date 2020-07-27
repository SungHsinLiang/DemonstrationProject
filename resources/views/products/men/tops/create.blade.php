@extends('layouts.layout')

@section('title', '新增男上衣')

@section('main_content')

@include('administrators.nav')

<div class="container my-3">
	<product-men-tops-create product_men_tops_create="{{ route('product.men.tops.create') }}" styles="{{ json_encode($styles) }}">
	</product-men-tops-create>
</div>

@endsection