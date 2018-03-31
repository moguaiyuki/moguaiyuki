<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Tag;
use App\TedTalk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TedTalksController extends Controller
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
        //TODO 関数化
        $tags = Tag::with('talks')->get();
        $talk_tags = [];
        foreach ($tags as $tag) {
            if (($tag->talks->isNotEmpty())) {
                $talk_tags["$tag->id"] = $tag->name;
            }
        }

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

        //TODO: あとで別関数に
        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $talk_data['image_id'] = $image->id;
        }

        $talk_data['presented_at'] = Carbon::createFromDate($request->presented_year, $request->presented_month, 1);

        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
            }
            $tags_id[] = $new_tag->id;
        }

        $talk = TedTalk::create($talk_data);

        if($request->tag) {
            $talk->tags()->sync($talk_data['tag']);
        }
        $talk->tags()->attach($tags_id);

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
        //
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
        //
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
}