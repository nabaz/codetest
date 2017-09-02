<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pw = 'test1234';

      $users = array(
         ['first_name' => 'Foo1', 'last_name' => 'Bar1', 'email' => 'foo1.bar1@example.com', 'password' => \Hash::make($pw)],
         ['first_name' => 'Foo2', 'last_name' => 'Bar2', 'email' => 'foo2.bar2@example.com', 'password' => \Hash::make($pw)],
         ['first_name' => 'Foo3', 'last_name' => 'Bar3', 'email' => 'foo3.bar3@example.com', 'password' => \Hash::make($pw)],
         ['first_name' => 'Foo4', 'last_name' => 'Bar4', 'email' => 'foo4.bar4@example.com', 'password' => \Hash::make($pw)],
         ['first_name' => 'Foo5', 'last_name' => 'Bar5', 'email' => 'foo5.bar5@example.com', 'password' => \Hash::make($pw)],
      );

       foreach ($users as $user)
       {
           \App\User::create([
             'first_name' => $user['first_name'],
             'last_name' => $user['last_name'],
             'email' => $user['email'],
             'password' => $user['password']
           ]);
       }

       //$this->info('Users Table successfully seeded...');


       // seed products

       $products = array(
          ['name' => 'Produt 1', 'description' => 'Product1 description', 'price' => rand(1,200),
          'image' => \Hash::make($pw), 'user_id' => \App\User::first()->id],
          ['name' => 'Produt 2', 'description' => 'Produ2 description', 'price' => rand(1,200),
          'image' => \Hash::make($pw), 'user_id' => \App\User::first()->id ],
          ['name' => 'Produt 3', 'description' => 'Produ3 description', 'price' => rand(1,200),
          'image' => \Hash::make($pw), 'user_id' => \App\User::first()->id  ],
          ['name' => 'Produt 4', 'description' => 'Produ4 description', 'price' => rand(1,200),
          'image' => \Hash::make($pw), 'user_id' => \App\User::first()->id ],
          ['name' => 'Produt 5', 'description' => 'Produ5 description', 'price' => rand(1,200),
          'image' => \Hash::make($pw), 'user_id' => \App\User::first()->id  ],

       );

       foreach ($products as $product)
       {
           \App\Product::create([
             'name' => $product['name'],
             'description' => $product['description'],
             'image' => $product['image'],
             'price' => $product['price'],
             'user_id' => $product['user_id']
           ]);
       }

      // $this->info('Products Table successfully seeded...');

    }



}
