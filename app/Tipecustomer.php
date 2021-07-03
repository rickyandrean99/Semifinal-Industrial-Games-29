<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipecustomer extends Model
{
    public function customers() {
        return $this->hasMany('App\Customer', 'tipecustomers_id', 'id');
    }
}
