<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Tag;
use App\TedTalk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TedTalksController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talks = TedTalk::orderBy('id', 'desc')->paginate(10);

        return view('admin.ted_talks.index', compact('talks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $talk_tags = $this->getTalkTags();

        return view('admin.ted_talks.create', compact('talk_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $talk_data = $request->all();

        if ($file = $request->file('image_id')) {
            $talk_data['image_id'] = $this->imageUpload($file);
        }

        $talk_data['presented_at'] = Carbon::createFromDate($request->presented_year, $request->presented_month, 1);

        $talk = TedTalk::create($talk_data);

        $this->attachTalkTag($talk, $request);

        if ($request->review) {
            return redirect()->route('admin.ted-talks.reviews.register', $talk->id);
        }

        //TODO: フラッシュ処理実装

        return redirect()->route('admin.ted-talks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $talk = TedTalk::findOrFail($id);

        return view('admin.ted_talks.detail', compact('talk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $talk = TedTalk::findOrFail($id);
        $tags = $this->getTalkTags();
        $talk_tags = $talk->tags->pluck('id')->all();

        return view('admin.ted_talks.edit', compact('talk', 'tags', 'talk_tags'));
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
        $talk= TedTalk::findOrFail($id);

        $talk_data = $request->all();

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $talk_data['image_id'] = $image->id;
            if ($talk->image) {
                unlink(public_path() . $talk->image->path);
            }
        }
        $talk->update($talk_data);

        $this->attachTalkTag($talk, $request);

        if ($request->review) {
            return redirect()->route('admin.ted-talks.reviews.edit', $talk->id);
        }

        return redirect()->route('admin.ted-talks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    *TED関連のタグを全て取得
     *
     * @return $talk_tags
    */
    private function getTalkTags()
    {
        $tags = Tag::with('talks')->get();
        $talk_tags = [];
        foreach ($tags as $tag) {
            if (($tag->talks->isNotEmpty())) {
                $talk_tags["$tag->id"] = $tag->name;
            }
        }
        return $talk_tags;
    }

    /**
    * TED TALKにタグをつける
    */
    private function attachTalkTag($talk, $request)
    {
        if($request->tag) {
            $talk->tags()->sync($request->tag);
        }
        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
                $tags_id[] = $new_tag->id;
            }
            $talk->tags()->attach($tags_id);
        }
    }
}
