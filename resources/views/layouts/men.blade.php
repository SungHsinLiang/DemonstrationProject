@extends('layouts.layout')

@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-2 bg-secondary">
            <men-left-navbar categories_route="{{ route('men.getCategories') }}"></men-left-navbar>
        </div>

        <div class="col-10 bg-info py-4">
            @yield('product_content')
        </div>
    </div>
</div>
@endsection