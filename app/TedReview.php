<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TedReview extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'content', 'user_id', 'status', 'talk_id', 'slug'
    ];

    /**
     * TED TALKを取得
     */
    public function image()
    {
        return $this->belongsTo('App\TedTalk');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
