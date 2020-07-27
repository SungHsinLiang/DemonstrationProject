@extends('layouts.layout')

@section('title', 'Home page')

@section('main_content')
<div class="container text-center my-3">
    <h1>This website is for practicing</h1>
    <h1>本網站為練習使用網站</h1>
</div>

<home-carousel carousels="{{ $carousels }}"></home-carousel>
@endsection