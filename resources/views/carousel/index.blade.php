@extends('layouts.layout')

@section('title', '管理 Carousel')

@section('main_content')

@include('administrators.nav')

<edite-carousel carousel_data="{{ isset($carousel_data)? $carousel_data:''}}"
  carousel_store_route="{{ route('carousel.store') }}"></edite-carousel>

@endsection