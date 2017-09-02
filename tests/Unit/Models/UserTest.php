<?php

namespace Tests\Models\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class UserTest extends TestCase
{
  use DatabaseMigrations;

  public function testUserEmailsAreUnique() {
    $user1 = factory(\App\User::class)->create([
      'email' => 'foo@bar.com',
     ]);
    $user2 = factory(\App\User::class)->make([
      'email' => 'foo@bar.com',
     ]);

    $this->assertEquals($user2->isValid(), false);
  }
}
