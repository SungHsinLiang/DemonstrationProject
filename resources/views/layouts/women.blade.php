@extends('layouts.layout')

@section('main_content')
<div class="container">
  <div class="row">
    <div class="col-2 bg-secondary">
      <women-left-navbar categories_route="{{ route('women.getCategories') }}"></women-left-navbar>
    </div>

    <div class="col-10 bg-info py-4">
      @yield('product_content')
    </div>
  </div>
</div>
@endsection