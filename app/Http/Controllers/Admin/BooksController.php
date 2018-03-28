<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Image;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO 関数化
        $tags = Tag::with('books')->get();
        $book_tags = [];
        foreach ($tags as $tag) {
            if (($tag->books->isNotEmpty())) {
                $book_tags["$tag->id"] = $tag->name;
            }
        }

        return view('admin.books.create', compact('book_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book_data = $request->all();
        $tags_id = [];

        //TODO: あとで別関数に
        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $book_data['image_id'] = $image->id;
        }

        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
            }
            $tags_id[] = $new_tag->id;
        }

        $book = Book::create($book_data);

        if($request->tag) {
            $book->tags()->sync($book_data['tag']);
        }
        $book->tags()->attach($tags_id);

        if ($request->review) {
            return redirect()->route('admin.books.reviews.register', $book->id);
        }

        //TODO: フラッシュ処理実装

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
