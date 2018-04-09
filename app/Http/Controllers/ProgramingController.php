<?php

namespace App\Http\Controllers;

use App\Programing;
use App\Tag;
use Illuminate\Http\Request;

class ProgramingController extends Controller
{
    private $perPage = 6;

    /**
     * 新しいProgramingControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $tags = $this->getProgramingTags();
        view()->share("tags", $tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programing = Programing::orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.programing.index', compact('programing'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $programing = Programing::whereSlug($slug)->first();

        return view('front.programing.detail', compact('programing'));
    }

    /**
    * タグに紐づいた投稿を取得
    */
    public function searchTag($id)
    {
        $search_tag = Tag::findOrFail($id);
        $programing = $search_tag->programing()->orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.programing.index', compact('programing', 'search_tag'));
    }

    /**
     * プログラミングのタグを取得
     */
    private function getProgramingTags()
    {
        $tags = Tag::with('programing')->get();
        $programing_tags = [];
        foreach ($tags as $tag) {
            if (($tag->programing->isNotEmpty())) {
                $programing_tags["$tag->id"] = $tag->name;
            }
        }
        return $programing_tags;
    }
}
