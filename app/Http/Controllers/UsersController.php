<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;
class UsersController extends ApiController
{
    public function index()
    {
      $users = \App\User::with(['products'])->get();

      return response($users)
          ->withHeaders([
              'Content-Type' => 'text/plain',
              'X-Header-One' => 'Header Value',
              'X-Header-Two' => 'Header Value',
          ]);
    }

    public function show($id)
    {
      $user = \App\User::with('products')->find($id);

      return response($user)
          ->withHeaders([
              'Content-Type' => 'text/plain',
              'X-Header-One' => 'Header Value',
              'X-Header-Two' => 'Header Value',
          ]);
    }

    public function removeProductFromRequestingUser($id)
    {
      $user = \App\User::find($id);
      $user->products()->delete();

    }
}
