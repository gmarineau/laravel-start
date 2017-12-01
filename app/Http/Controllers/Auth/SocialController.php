<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Socialite;

class SocialController extends Controller
{
  /**
   * Redirect the user to the GitHub authentication page.
   *
   * @return \Illuminate\Http\Response
   */
  public function redirectToProvider($service)
  {
    return Socialite::driver($service)->redirect();
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleProviderCallback($service)
  {
    dd(Socialite::driver($service)->user());
    $user = Socialite::driver($service)->user();
  }
}
