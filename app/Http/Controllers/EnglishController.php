<?php

namespace App\Http\Controllers;

use App\English;
use App\Tag;
use Illuminate\Http\Request;

class EnglishController extends Controller
{
    private $perPage = 6;

    /**
     * 新しいEnglishControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $tags = $this->getEnglishTags();
        view()->share("tags", $tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $english = English::orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.english.index', compact('english'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $english = English::whereSlug($slug)->first();

        return view('front.english.detail', compact('english'));
    }

    /**
     * タグに紐づいた投稿を取得
     */
    public function searchTag($id)
    {
        $search_tag = Tag::findOrFail($id);
        $english = $search_tag->english()->orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.english.index', compact('english', 'search_tag'));
    }

    /**
     * プログラミングのタグを取得
     */
    private function getEnglishTags()
    {
        $tags = Tag::with('english')->get();
        $english_tags = [];
        foreach ($tags as $tag) {
            if (($tag->english->isNotEmpty())) {
                $english_tags["$tag->id"] = $tag->name;
            }
        }
        return $english_tags;
    }
}
