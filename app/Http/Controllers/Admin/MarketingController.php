<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Marketing;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketings = Marketing::orderBy('id', 'desc')->paginate(10);

        return view('admin.marketing.index', compact('marketings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marketing_tags = $this->getMarketingTags();

        return view('admin.marketing.create', compact('marketing_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marketing_data = $request->all();

        if ($file = $request->file('image_id')) {
            $marketing_data['image_id'] = $this->imageUpload($file);
        }

        $marketing_data['user_id'] = Auth::user()->id;

        $marketing = Marketing::create($marketing_data);

        $this->attachMarketingTag($marketing, $request);

        //TODO: フラッシュ処理実装

        return redirect()->route('admin.marketing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marketing = Marketing::findOrFail($id);

        return view('admin.marketing.detail', compact('marketing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marketing = Marketing::findOrFail($id);

        $tags = $this->getMarketingTags();
        $marketing_tags = $marketing->tags->pluck('id')->all();

        return view('admin.marketing.edit', compact('marketing', 'marketing_tags', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marketing = Marketing::findOrFail($id);

        $marketing_data = $request->all();

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $marketing_data['image_id'] = $image->id;
            if ($marketing->image) {
                unlink(public_path() . $marketing->image->path);
            }
        }

        $marketing->update($marketing_data);

        $this->attachMarketingTag($marketing, $request);

        return redirect()->route('admin.marketing.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marketing = Marketing::findOrFail($id);

        if ($marketing->image) {
            unlink(public_path() . $marketing->image->path);
        }

        $marketing->delete();

        return redirect()->route('admin.marketing.index');
    }

    /**
     * マーケティングのタグを取得
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

    /**
     * マーケティングにタグづけ
     */
    private function attachMarketingTag($marketing, $request)
    {
        if($request->tag) {
            $marketing->tags()->sync($request->tag);
        }
        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
                $tags_id[] = $new_tag->id;
            }
            $marketing->tags()->attach($tags_id);
        }
    }
}
