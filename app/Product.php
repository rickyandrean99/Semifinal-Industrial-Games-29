<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function customers() {
        return $this->hasMany('App\Customer', 'syarat_produk', 'id');
    }

    public function teams() {
        return $this->belongsToMany('App\Team','product_team','products_id','teams_id')->withPivot('harga_jual','sesi_beli', 'quantity');
    }
}
