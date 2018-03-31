<?php

namespace App\Http\Controllers\Admin;

use App\TedReview;
use App\TedTalk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TedReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review_data =  $request->all();

        $review_data['user_id'] = Auth::user()->id;

        TedReview::create($review_data);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($talk_id)
    {
        if ($review = TedTalk::findOrfail($talk_id)->review) {
            return view('admin.ted_talks.reviews.edit', compact('talk_id', 'review'));
        }
        return redirect()->route('admin.ted-talks.reviews.register', $talk_id);
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
        TedReview::findOrFail($id)->update($request->all());

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
     *
     */
    public function register($talk_id)
    {
        return view('admin.ted_talks.reviews.create',  compact('talk_id'));
    }
}
