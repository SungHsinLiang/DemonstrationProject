@extends('layouts.layout')

@section('title', '新增商品類型')

@section('main_content')

@include('administrators.nav')

<div class="container">
  @if (isset($createdSuccessfully))
  <h1 class="text-danger text-center">{{ $createdSuccessfully }}</h1>
  @endif
  @if (isset($errorMessage))
  <h1 class="text-danger text-center">{{ $errorMessage }}</h1>
  @endif

  {{-- <product-men-bottoms-create product_men_tops_create="{{ route('product.men.bottoms.create') }}"
  styles="{{ json_encode($styles) }}" errors="{{ $errors ?? '' }}" olds="{{ json_encode(Session::getOldInput()) }}">
  </product-men-bottoms-create> --}}
  <product-categories-create product_categories_create="{{ route('product.categories.create') }}"
    errors="{{ $errors ?? '' }}" olds="{{ json_encode(Session::getOldInput()) }}">
  </product-categories-create>

</div>

@endsection