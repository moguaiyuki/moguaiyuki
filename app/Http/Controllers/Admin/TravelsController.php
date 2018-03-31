<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Tag;
use App\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TravelsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::paginate(10);

        return view('admin.travels.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $travel_tags = $this->getTravelTags();

        return view('admin.travels.create', compact('travel_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $travel_data =  $request->all();

        $travel_data['user_id'] = Auth::user()->id;

        if ($file = $request->file('image_id')) {
            $travel_data['image_id'] = $this->imageUpload($file);
        }

        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
            }
            $tags_id[] = $new_tag->id;
        }

        $travel = Travel::create($travel_data);

        if($request->tag) {
            $travel->tags()->sync($travel_data['tag']);
        }
        $travel->tags()->attach($tags_id);

        return redirect()->route('admin.travels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $travel = Travel::findOrFail($id);

        return view('admin.travels.detail', compact('travel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel = Travel::findOrFail($id);
        $tags = $this->getTravelTags();
        $travel_tags = $travel->tags->pluck('id')->all();

        return view('admin.travels.edit', compact('travel', 'tags', 'travel_tags'));
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
        $travel = Travel::findOrFail($id);

        $travel_data = $request->all();

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $travel_data['image_id'] = $image->id;
            if ($travel->image) {
                unlink(public_path() . $travel->image->path);
            }
        }

        $travel->update($travel_data);

        $this->attachTravelTag($travel, $request);

        return redirect()->route('admin.travels.index');
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
     *旅関連のタグを全て取得
     *
     * @return $talk_tags
     */
    private function getTravelTags()
    {
        $tags = Tag::with('travels')->get();
        $travel_tags = [];
        foreach ($tags as $tag) {
            if (($tag->travels->isNotEmpty())) {
                $travel_tags["$tag->id"] = $tag->name;
            }
        }
        return $travel_tags;
    }

    /**
    * 旅にタグづけ
    */
    private function attachTravelTag($travel, $request)
    {
        if($request->tag) {
            $travel->tags()->sync($request->tag);
        }
        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
            }
            $tags_id[] = $new_tag->id;
            $travel->tags()->attach($tags_id);
        }
    }
}
