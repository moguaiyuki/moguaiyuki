<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Travel;
use Illuminate\Http\Request;

class TravelsController extends Controller
{
    private $perPage = 6;

    /**
     * 新しいTravelsControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $tags = $this->getTravelTags();
        view()->share("tags", $tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.travels.index', compact('travels'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $travel = Travel::whereSlug($slug)->first();

        return view('front.travels.detail', compact('travel'));
    }

    /**
     * タグに紐づいた投稿を取得
     */
    public function searchTag($id)
    {
        $search_tag = Tag::findOrFail($id);
        $travels = $search_tag->travels()->orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.travels.index', compact('travels', 'search_tag'));
    }

    /**
     * プログラミングのタグを取得
     */
    private function getTravelTags()
    {
        $tags = Tag::with('travels')->get();
        $travels_tags = [];
        foreach ($tags as $tag) {
            if (($tag->travels->isNotEmpty())) {
                $travels_tags["$tag->id"] = $tag->name;
            }
        }
        return $travels_tags;
    }
}
