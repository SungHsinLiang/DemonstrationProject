@extends('layouts.layout')

@section('main_content')
<div class="container">
  <div class="row">
    <div class="col-2">
      <men-left-navbar categories_route="{{ route('men.getCategories') }}"></men-left-navbar>
    </div>

    <div class="col-10 py-4">
      @yield('product_content')
    </div>
  </div>
</div>
@endsection