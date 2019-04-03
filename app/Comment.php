<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comics()
    {
        return $this->belongsTo('App\Comic', 'comic_id');
    }
}
