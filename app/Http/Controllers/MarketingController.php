<?php

namespace App\Http\Controllers;

use App\Marketing;
use App\Tag;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    private $perPage = 6;

    /**
     * 新しいMarketingControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $tags = $this->getMarketingTags();
        view()->share("tags", $tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketing = Marketing::orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.marketing.index', compact('marketing'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $marketing = Marketing::whereSlug($slug)->first();

        return view('front.marketing.detail', compact('marketing'));
    }

    /**
     * タグに紐づいた投稿を取得
     */
    public function searchTag($id)
    {
        $search_tag = Tag::findOrFail($id);
        $marketing = $search_tag->marketing()->orderBy('id', 'desc')->whereIsPublished(1)->paginate($this->perPage);

        return view('front.marketing.index', compact('marketing', 'search_tag'));
    }

    /**
     * プログラミングのタグを取得
     */
    private function getMarketingTags()
    {
        $tags = Tag::with('marketing')->get();
        $marketing_tags = [];
        foreach ($tags as $tag) {
            if (($tag->marketing->isNotEmpty())) {
                $marketing_tags["$tag->id"] = $tag->name;
            }
        }
        return $marketing_tags;
    }
}
