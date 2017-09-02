<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends ApiController
{
    //
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \App\Product::all();
        return response($products)
            ->withHeaders([
                'Content-Type' => 'text/json',
                'X-Header-One' => 'Header Value',
                'X-Header-Two' => 'Header Value',
            ]);
    }

    public function show($id)
    {
        $product = \App\Product::find($id);

        return response($product)
            ->withHeaders([
                'Content-Type' => 'text/json',
                'X-Header-One' => 'Header Value',
                'X-Header-Two' => 'Header Value',
            ]);

    }

    public function store(Request $request)
    {
        $attributes = array_get($request, 'data.attributes', []);
        $product = new \App\Product($attributes);
        $product->save();
        return $this->getCreatedResponse($product);
    }

    public function update(Request $request, $id)
    {
        $product = \App\Product::findOrFail($id);
        $product->fill($product);

        return $this->getResponse($product);
    }

    public function destroy($id)
    {
      $product = \App\Product::find($id);
      $product->delete();
    }
}
