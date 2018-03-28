<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Tag;
use App\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TravelsController extends Controller
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
        //TODO 関数化
        $tags = Tag::with('travels')->get();
        $travel_tags = [];
        foreach ($tags as $tag) {
            if (($tag->travels->isNotEmpty())) {
                $travel_tags["$tag->id"] = $tag->name;
            }
        }

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

        //todo:　関数化

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $travel_data['image_id'] = $image->id;
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
        //
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
