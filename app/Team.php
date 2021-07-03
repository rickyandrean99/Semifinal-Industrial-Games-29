<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function regiondetails() {
        return $this->hasMany('App\Regiondetail', 'teams_id', 'id');
    }

    public function products() {
        return $this->belongsToMany('App\Product','product_team','teams_id','products_id')->withPivot('harga_jual','sesi_beli', 'quantity');
    }

    public function forecasts() {
        return $this->belongsToMany('App\Forecast','forecast_team','teams_id','forecasts_id');
    }
}
