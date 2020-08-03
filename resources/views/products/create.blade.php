@extends('layouts.layout')

@section('title', '新增商品')

@section('main_content')

@include('administrators.nav')

<div class="container">
  @if (isset($createdSuccessfully))
  <h1 class="text-danger text-center">{{ $createdSuccessfully }}</h1>
  @endif
  @if (isset($errorMessage))
  <h1 class="text-danger text-center">{{ $errorMessage }}</h1>
  @endif

  <product-create product_store="{{ route('product.store') }}" errors="{{ $errors ?? '' }}"
    olds="{{ json_encode(Session::getOldInput()) }}"
    search_category_and_style_route="{{ $search_category_and_style_route }}">
  </product-create>

</div>

@endsection