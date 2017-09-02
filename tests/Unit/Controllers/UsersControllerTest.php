<?php

namespace Tests\Unit\controllers;
use Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
  use DatabaseMigrations;

  public function loginUser($user)
  {
      Auth::login($user, true);
  }
  //Attach product to requesting user

  public function testAttachProductToRequestingUser()
  {
    $user1 = factory(\App\User::class)->make([
      'email' => 'foo@bar.com',
     ]);

    $this->loginUser($user1);
    $product1 = factory(\App\Product::class)->make([
       'user_id' => $user1->id,
    ]);
    $response = $this->get('/users');
    $this->assertEquals(200, $response->status());

  }

  //Remove product from requesting user

  public function testRemoveProductFromRequestingUser()
  {
    $user1 = factory(\App\User::class)->create([
      'email' => 'foo@bar.com',
     ]);
    $this->loginUser($user1);
    $produt1 = factory(\App\Product::class)->create([
     'user_id' => $user1->id,
    ]);

    $response = $this->json('GET', '/products', ['id' => $produt1->id]);

    $this->assertEquals(200, $response->status());
  }

//vList products attached to requesting user

  public function testListProductsToRequestedUser()
  {
    $user1 = factory(\App\User::class)->make([
      'email' => 'foo@bar.com',
     ]);

     $this->loginUser($user1);

    $response = $this->get('/users/'. $user1->id);
    $this->assertEquals(200, $response->status());

  }

}
