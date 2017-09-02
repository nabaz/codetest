<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'description', 'price', 'image', 'user_id'
    ];

    protected static $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required'
    ];

    public function user()
    {
      return $this->belongsTo('App/User');
    }
}
