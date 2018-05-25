<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = str_slug($model->title . $model->id);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
