<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Programing;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProgramingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programings = Programing::orderBy('id', 'desc')->paginate(10);

        return view('admin.programing.index', compact('programings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programing_tags = $this->getProgramingTags();

        return view('admin.programing.create', compact('programing_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $programing_data = $request->all();

        if ($file = $request->file('image_id')) {
            $programing_data['image_id'] = $this->imageUpload($file);
        }

        $programing_data['user_id'] = Auth::user()->id;

        $programing = Programing::create($programing_data);

        $this->attachProgramingTag($programing, $request);

        //TODO: フラッシュ処理実装

        return redirect()->route('admin.programing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programing = Programing::findOrFail($id);

        return view('admin.programing.detail', compact('programing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programing = Programing::findOrFail($id);

        $tags = $this->getProgramingTags();
        $programing_tags = $programing->tags->pluck('id')->all();

        return view('admin.programing.edit', compact('programing', 'programing_tags', 'tags'));
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
        $programing = Programing::findOrFail($id);

        $programing_data = $request->all();

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $programing_data['image_id'] = $image->id;
            if ($programing->image) {
                unlink(public_path() . $programing->image->path);
            }
        }

        $programing->update($programing_data);

        $this->attachProgramingTag($programing, $request);


        return redirect()->route('admin.programing.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programing = Programing::findOrFail($id);

        if ($programing->image) {
            unlink(public_path() . $programing->image->path);
        }

        $programing->delete();

        return redirect()->route('admin.programing.index');
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

    /**
     * プログラミングにタグづけ
     */
    private function attachProgramingTag($programing, $request)
    {
        if($request->tag) {
            $programing->tags()->sync($request->tag);
        }
        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
                $tags_id[] = $new_tag->id;
            }
            $programing->tags()->attach($tags_id);
        }
    }
}
