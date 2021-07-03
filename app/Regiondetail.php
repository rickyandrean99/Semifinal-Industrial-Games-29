<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regiondetail extends Model
{
    protected $table = "regiondetails";

    public function team() {
        return $this->belongsTo('App\Team', 'teams_id');
    }

    public function region() {
        return $this->belongsTo('App\Region', 'regions_id');
    }
}
