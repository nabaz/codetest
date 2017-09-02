<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Validator;
use App\Exceptions\ModelValidationException;

class User  extends BaseModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    protected static $rules = [
      'email' => 'required|unique:users',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
      return $this->hasMany('App\Product');
    }

    public function name()
    {
      return $this->firstName . " " . $this->lastName;
    }
}
