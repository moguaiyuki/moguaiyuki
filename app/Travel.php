<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Travel extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'content', 'country', 'user_id', 'start_date', 'end_date', 'is_published', 'slug', 'image_id'
    ];

    protected $dates = ['start_date', 'end_date'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'country'
            ]
        ];
    }

    /**
     *  旅行のタグを取得
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

}