<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    public function comics()
    {
        return $this->belongsToMany('App\Comic', 'comics_episodes', 'episode_id', 'comic_id');
    }

}
