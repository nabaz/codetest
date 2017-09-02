<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
  use DatabaseMigrations;

    public function testProductFieldsRequired()
    {

      $produt1 = factory(\App\Product::class)->make([
       'name' => '',
       'user_id' => '1'
      ]);
      $produt2 = factory(\App\Product::class)->make([
       'price' => null,
       'user_id' => '1'
      ]);
      $produt3 = factory(\App\Product::class)->make([
       'description' => '',
       'user_id' => '1'
      ]);
      $produt4 = factory(\App\Product::class)->make([
       'image' => null,
       'user_id' => '1'
      ]);
      $this->assertEquals($produt1->isValid(), false);
      $this->assertEquals($produt2->isValid(), false);
      $this->assertEquals($produt3->isValid(), false);
      $this->assertEquals($produt4->isValid(), true);
    }
}
