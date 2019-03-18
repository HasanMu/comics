<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{

    public function comics()
    {
        return $this->belongsToMany('App\Comic', 'comics_days', 'day_id', 'comic_id');
    }

}
