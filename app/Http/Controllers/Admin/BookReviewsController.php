<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\BookReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookReviewsController extends Controller
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
        //
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

        BookReview::create($review_data);

        return redirect()->route('admin.books.index');
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
    public function edit($book_id)
    {
        if ($review = Book::findOrfail($book_id)->review) {
            return view('admin.books.reviews.edit', compact('book_id', 'review'));
        }
        return redirect()->route('admin.books.reviews.register', $book_id);
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
        BookReview::findOrFail($id)->update($request->all());

        return redirect()->route('admin.books.index');
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
    public function register($book_id)
    {
        return view('admin.books.reviews.create',  compact('book_id'));
    }
}
