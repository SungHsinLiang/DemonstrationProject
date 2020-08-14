<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Str;
use Hash;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function github()
  {
    // send the user's request to github
    return Socialite::driver('github')->redirect();
  }

  public function githubRedirect()
  {
    // get oauth request back from github to authenticate user
    $user = Socialite::driver('github')->stateless()->user();

    // if this user doesn't exist, add them
    // if they do, get the model
    // either way , authenticate the user into the application and redirect afterwards
    $user = User::firstOrCreate([
      'email' => $user->email
    ], [
      'name' => $user->name,
      'email' => $user->email,
      'password' => Hash::make(Str::random(24)),
    ]);

    if (is_null($user->email_verified_at)) {
      $user->email_verified_at = now();
      $user->save();
    }

    Auth()->login($user);

    return redirect('/');
  }

  public function google()
  {
    // send the user's request to google
    return Socialite::driver('google')->redirect();
  }

  public function googleRedirect()
  {
    // get oauth request back from google to authenticate user
    $user = Socialite::driver('google')->stateless()->user();

    // dd($user);

    // if this user doesn't exist, add them
    // if they do, get the model
    // either way , authenticate the user into the application and redirect afterwards
    $user = User::firstOrCreate([
      'email' => $user->email
    ], [
      'name' => $user->name,
      'email' => $user->email,
      'password' => Hash::make(Str::random(24)),
    ]);

    if (is_null($user->email_verified_at)) {
      $user->email_verified_at = now();
      $user->save();
    }

    Auth()->login($user);

    return redirect('/');
  }

  public function facebook()
  {
    // send the user's request to facebook
    return Socialite::driver('facebook')->redirect();
  }

  public function facebookRedirect()
  {
    // get oauth request back from facebook to authenticate user
    $user = Socialite::driver('facebook')->stateless()->user();

    // dd($user);

    // if this user doesn't exist, add them
    // if they do, get the model
    // either way , authenticate the user into the application and redirect afterwards
    $user = User::firstOrCreate([
      'email' => $user->email
    ], [
      'name' => $user->name,
      'email' => $user->email,
      'password' => Hash::make(Str::random(24)),
    ]);

    if (is_null($user->email_verified_at)) {
      $user->email_verified_at = now();
      $user->save();
    }

    Auth()->login($user);

    return redirect('/');
  }
}
