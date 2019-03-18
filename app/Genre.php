<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    public function comics()
    {
        return $this->belongsToMany('App\Comic', 'comics_genres', 'genre_id', 'comic_id');
    }

}
