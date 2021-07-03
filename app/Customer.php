<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    public function products() {
        return $this->belongsTo('App\Product', 'syarat_produk');
    }

    public function regions() {
        return $this->belongsTo('App\Region', 'syarat_wilayah');
    }

    public function tipecustomers() {
        return $this->belongsTo('App\Tipecustomer', 'tipecustomers_id');
    }
}
