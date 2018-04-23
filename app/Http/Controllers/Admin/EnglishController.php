<?php

namespace App\Http\Controllers\Admin;

use App\English;
use App\Image;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EnglishController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $englishes = English::orderBy('id', 'desc')->paginate(10);

        return view('admin.english.index', compact('englishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $english_tags = $this->getEnglishTags();

        return view('admin.english.create', compact('english_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $english_data = $request->all();

        if ($file = $request->file('image_id')) {
            $english_data['image_id'] = $this->imageUpload($file);
        }

        $english_data['user_id'] = Auth::user()->id;

        $english = English::create($english_data);

        $this->attachEnglishTag($english, $request);

        //TODO: フラッシュ処理実装

        return redirect()->route('admin.english.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $english = English::findOrFail($id);

        return view('admin.english.detail', compact('english'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $english = English::findOrFail($id);

        $tags = $this->getEnglishTags();
        $english_tags = $english->tags->pluck('id')->all();

        return view('admin.english.edit', compact('english', 'english_tags', 'tags'));
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
        $english = English::findOrFail($id);

        $english_data = $request->all();

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $english_data['image_id'] = $image->id;
            if ($english->image) {
                unlink(public_path() . $english->image->path);
            }
        }

        $english->update($english_data);

        $this->attachEnglishTag($english, $request);


        return redirect()->route('admin.english.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $english = English::findOrFail($id);

        if ($english->image) {
            unlink(public_path() . $english->image->path);
        }

        $english->delete();

        return redirect()->route('admin.english.index');
    }

    /**
     * 英語のタグを取得
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

    /**
     * 英語にタグづけ
     */
    private function attachEnglishTag($english, $request)
    {
        if($request->tag) {
            $english->tags()->sync($request->tag);
        }
        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
                $tags_id[] = $new_tag->id;
            }
            $english->tags()->attach($tags_id);
        }
    }
}
