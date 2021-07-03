<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = "regions";

    public function regiondetails() {
        return $this->hasMany('App\Regiondetail', 'regions_id', 'id');
    }

    public function customers() {
        return $this->hasMany('App\Customers', 'syarat_wilayah', 'id');
    }
}
