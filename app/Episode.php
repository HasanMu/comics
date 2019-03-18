<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    public function comics()
    {
        return $this->belongsTo('App\Comic', 'episode_id');
    }

}
