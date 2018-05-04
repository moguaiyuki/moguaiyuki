<?php

namespace App\Http\Controllers;

use App\Tag;
use App\TedReview;
use App\TedTalk;
use Illuminate\Http\Request;

class TedTalksController extends Controller
{
    private $perPage = 6;

    /**
     * 新しいTedTalksControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $tags = $this->getTedTalkTags();
        view()->share("tags", $tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talks = TedTalk::orderBy('id', 'desc')->paginate($this->perPage);

        return view('front.ted_talks.index', compact('talks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $review = TedReview::whereSlug($slug)->first();

        return view('front.ted_talks.detail', compact('review'));
    }

    /**
     * タグに紐づいた投稿を取得
     */
    public function searchTag($id)
    {
        $search_tag = Tag::findOrFail($id);
        $talks = $search_tag->talks()->orderBy('id', 'desc')->paginate($this->perPage);

        return view('front.ted_talks.index', compact('talks', 'search_tag'));
    }

    /**
     * プログラミングのタグを取得
     */
    private function getTedTalkTags()
    {
        $tags = Tag::with('talks')->get();
        $talks_tags = [];
        foreach ($tags as $tag) {
            if (($tag->talks->isNotEmpty())) {
                $talks_tags["$tag->id"] = $tag->name;
            }
        }
        return $talks_tags;
    }
}
