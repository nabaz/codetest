<?php

namespace Tests\Unit\controllers;
use Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsControllerTest extends TestCase
{
  use DatabaseMigrations;

  public function loginUser($user)
  {
      Auth::login($user, true);
  }

  # GET /products/id
  public function testCheckRedirectToLoginIfNotAuthenticated() {
      $response = $this->call('GET', 'products');
      // Just check that you don't get a 200 OK response.
      $this->assertFalse($response->isOk());
      // Make sure you've been redirected.
      $this->assertTrue($response->isRedirection());
  }

  public function testAllProducts()
  {
    $user1 = factory(\App\User::class)->make([
      'email' => 'foo@bar.com',
     ]);

    $this->loginUser($user1);
    $response = $this->get('/products');
    $this->assertEquals(200, $response->status());



  }

  public function testAllProductShow()
  {
    $user1 = factory(\App\User::class)->make([
      'email' => 'foo@bar.com',
     ]);

     $this->loginUser($user1);

    $product1 = factory(\App\Product::class)->make([
       'user_id' => $user1->id,
    ]);

    $response = $this->get('/products/'. $product1->id);
    $this->assertEquals(200, $response->status());

  }

  public function testProductCreation()
  {
    $user1 = factory(\App\User::class)->create([
      'email' => 'foo@bar.com',
     ]);
    $this->loginUser($user1);
    $response = $this->json('post',
         '/products', [
                'data' => [
                    'attributes' => [
                      'name' => 'product1 test name',
                      'description' => 'product1 description',
                      'price' => 100,
                      'image' => 'http://google.com/test',
                      'user_id' => $user1->id
                    ],
            ]

         ]);
    $this->assertEquals(200, $response->status());

  }

  public function testDeleteProduct()
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
}
