@extends('layouts.layout')

@section('title', 'Email 驗證')

@section('main_content')
<div class="container text-center my-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">請先驗證 Email 信箱</div>

          <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
              {{-- {{ __('A fresh verification link has been sent to your email address.') }} --}}
              已將新的驗證信件送至您的 Email，請前往確認並驗證。
            </div>
            @endif

            進行下一步之前，請先至您的電子郵件信箱點選驗證連結。
            <br>
            若無收到電子郵件，
            <br>
            <br>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn btn-link p-2 m-0 align-baseline">重寄驗證信件</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection