<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\users;

class usersController extends Controller
{
   public function auth()
   {
       $auth = users::all();
   return view('auth.login' , ['auth' => $auth]);
   }
}
