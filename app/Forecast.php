<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    public function teams() {
        return $this->belongsToMany('App\Team', 'forecast_team', 'forecasts_id', 'teams_id');
    }
}
