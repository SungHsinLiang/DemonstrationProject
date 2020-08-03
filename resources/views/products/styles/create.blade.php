@extends('layouts.layout')

@section('title', '新增商品風格')

@section('main_content')

@include('administrators.nav')

<div class="container">
  @if (isset($createdSuccessfully))
  <h1 class="text-danger text-center">{{ $createdSuccessfully }}</h1>
  @endif
  @if (isset($errorMessage))
  <h1 class="text-danger text-center">{{ $errorMessage }}</h1>
  @endif

  {{-- @foreach ($men_categories as $item)
  {{ $item->category }}
  <br>
  @endforeach --}}

  {{-- <product-men-bottoms-create product_men_tops_create="{{ route('product.men.bottoms.create') }}"
  styles="{{ json_encode($styles) }}" errors="{{ $errors ?? '' }}" olds="{{ json_encode(Session::getOldInput()) }}">
  </product-men-bottoms-create> --}}

  <product-styles-create product_styles_create="{{ route('product.styles.create') }}" errors="{{ $errors ?? '' }}"
    olds="{{ json_encode(Session::getOldInput()) }}" men_categories="{{ $men_categories }}"
    women_categories="{{ $women_categories }}">
  </product-styles-create>

</div>

@endsection