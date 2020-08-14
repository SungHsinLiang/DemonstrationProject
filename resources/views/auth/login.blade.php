@extends('layouts.layout')

@section('title', 'Login')

@section('main_content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 my-3">
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
                @endif
              </div>
            </div>

            <div class="container">
              <div class="row">
                {{-- login using Github --}}
                <div class="my-4 col-4">
                  <a href="{{ route("login.github") }}" class="btn btn-secondary btn-block">
                    <svg width="32" height="32" viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z">
                      </path>
                    </svg>
                    <br>
                    Login using GitHub
                  </a>
                </div>

                {{-- login using Google --}}
                <div class="my-4 col-4">
                  <a href="{{ route("login.google") }}" class="btn btn-secondary btn-block">
                    <svg width="32" height="32" viewBox="0 0 24 24">
                      <path
                        d="M23.52 12.2727C23.52 11.4218 23.4436 10.6036 23.3018 9.81816H12V14.46H18.4582C18.18 15.96 17.3345 17.2309 16.0636 18.0818V21.0927H19.9418C22.2109 19.0036 23.52 15.9273 23.52 12.2727Z"
                        fill="#4285F4" />
                      <path
                        d="M12 24C15.24 24 17.9564 22.9255 19.9418 21.0927L16.0637 18.0818C14.9891 18.8018 13.6146 19.2273 12 19.2273C8.87456 19.2273 6.22911 17.1164 5.28547 14.28H1.27638V17.3891C3.25093 21.3109 7.30911 24 12 24Z"
                        fill="#34A853" />
                      <path
                        d="M5.28545 14.28C5.04545 13.56 4.90909 12.7909 4.90909 12C4.90909 11.2091 5.04545 10.44 5.28545 9.71998V6.61089H1.27636C0.463636 8.23089 0 10.0636 0 12C0 13.9363 0.463636 15.7691 1.27636 17.3891L5.28545 14.28Z"
                        fill="#FBBC05" />
                      <path
                        d="M12 4.77273C13.7618 4.77273 15.3437 5.37818 16.5873 6.56727L20.0291 3.12545C17.9509 1.18909 15.2346 0 12 0C7.30911 0 3.25093 2.68909 1.27638 6.61091L5.28547 9.72C6.22911 6.88364 8.87456 4.77273 12 4.77273Z"
                        fill="#EA4335" />
                    </svg>
                    <br>
                    Login using Google
                  </a>
                </div>

                {{-- login using Facebook --}}
                <div class="my-4 col-4">
                  <a href="{{ route("login.facebook") }}" class="btn btn-secondary btn-block">
                    <svg viewBox="0 0 36 36" height="32" width="32">
                      <path id="fb-bg" fill="#0062E0"
                        d="M15 35.8C6.5 34.3 0 26.9 0 18 0 8.1 8.1 0 18 0s18 8.1 18 18c0 8.9-6.5 16.3-15 17.8l-1-.8h-4l-1 .8z">
                      </path>
                      <path id="fb-font" fill="#DDD"
                        d="M25 23l.8-5H21v-3.5c0-1.4.5-2.5 2.7-2.5H26V7.4c-1.3-.2-2.7-.4-4-.4-4.1 0-7 2.5-7 7v4h-4.5v5H15v12.7c1 .2 2 .3 3 .3s2-.1 3-.3V23h4z">
                      </path>
                    </svg>
                    <br>
                    Login using Facebook
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection