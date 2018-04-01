<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
    * タグのついた本を取得
    */
    public function books()
    {
        return $this->morphedByMany('App\Book', 'taggable');
    }

    /**
    * タグのついたのTED TALKを取得
    */
    public function talks()
    {
        return $this->morphedByMany('App\TedTalk', 'taggable');
    }

    /**
     * タグのついたの旅行を取得
     */
    public function travels()
    {
        return $this->morphedByMany('App\Travel', 'taggable');
    }

    /**
     * タグのついたのプログラミングを取得
     */
    public function programing()
    {
        return $this->morphedByMany('App\Programing', 'taggable');
    }

}

