<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function days()
    {
        return $this->belongsToMany('App\Day', 'comics_days', 'comic_id', 'day_id');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'comics_genres', 'comic_id', 'genre_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'comics_users', 'comic_id', 'user_id');
    }

    public function episodes()
    {
        return $this->BelongsToMany('App\Episode', 'comics_episodes', 'comic_id', 'episode_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'comic_id');
    }
}
