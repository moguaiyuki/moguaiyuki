<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TedTalk extends Model
{
    protected $fillable = [
        'title', 'presenter', 'image_id', 'subtitle', 'status', 'is_favorite', 'presented_at', 'url'
    ];

    protected $dates = ['presented_at'];

    /**
     * TED TALKの画像を取得
     */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    /**
     * TED TALKの感想記事を取得
     */
    public function review()
    {
        return $this->hasOne('App\TedReview', 'talk_id');
    }

}