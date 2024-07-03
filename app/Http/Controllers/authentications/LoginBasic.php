<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()
        ->route('dashboard-analytics')
        ->withSuccess('You have successfully logged in!');
    }

    return back()
      ->withErrors([
        'email' => 'Your provided credentials do not match in our records.',
      ])
      ->onlyInput('email');
  }
}
