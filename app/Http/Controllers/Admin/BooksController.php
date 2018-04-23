<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Image;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends BaseController
{
    /**
     * 新しいBooksControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $tags = $this->getBookTags();
        view()->share("tags", $tags);
    }

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
        return view('admin.books.create');
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

        if (isset($book_data["image_url"])) {
            $data = file_get_contents($book_data["image_url"]);
            $image_name = time() . $book_data['title'];
            file_put_contents('images/'. $image_name, $data);
            $image = Image::create(['path' => $image_name]);
            $book_data['image_id'] = $image->id;
        } elseif ($file = $request->file('image_id')) {
            $book_data['image_id'] = $this->imageUpload($file);
        }

        $book = Book::create($book_data);

        $this->attachBookTag($book, $request);

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
        $book = Book::findOrFail($id);

        return view('admin.books.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $book_tags = $book->tags->pluck('id')->all();

        return view('admin.books.edit', compact('book', 'book_tags'));
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
        $book = Book::findOrFail($id);

        $book_data = $request->all();

        if ($file = $request->file('image_id')) {
            $image_name = time() . $file->getClientOriginalName();
            $file->move('images', $image_name);
            $image = Image::create(['path' => $image_name]);
            $book_data['image_id'] = $image->id;
            if ($book->image) {
                unlink(public_path() . $book->image->path);
            }
        }

        $book->update($book_data);

        $this->attachBookTag($book, $request);

        if ($request->review) {
            return redirect()->route('admin.books.reviews.edit', $book->id);
        }

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
        $book = Book::findOrFail($id);

        /*if ($book->image) {
            unlink(public_path() . $book->image->path);
        }*/

        $book->delete();

        return redirect()->back();
    }

    /**
     *　本のタグを取得
     */
    private function getBookTags()
    {
        $tags = Tag::with('books')->get();
        $book_tags = [];
        foreach ($tags as $tag) {
            if (($tag->books->isNotEmpty())) {
                $book_tags["$tag->id"] = $tag->name;
            }
        }
        return $book_tags;
    }

    /**
    * 本にタグづけ
    */
    private function attachBookTag($book, $request)
    {
        if($request->tag) {
            $book->tags()->sync($request->tag);
        }
        if ($tags = $request->name) {
            foreach ($tags as $tag) {
                $new_tag = Tag::create(['name'=>"$tag"]);
                $tags_id[] = $new_tag->id;
            }
            $book->tags()->attach($tags_id);
        }
    }

    /**
    * google api　から本の情報を取得
    */

    public function searchBooksInfo(Request $request)
    {
        $post_data = $request->all();
        $data = "https://www.googleapis.com/books/v1/volumes?q=".$post_data["book"]."&country=JP";
        $json = file_get_contents($data);
        $json_decode = json_decode($json, true);
        return view('admin.books.create', compact("json_decode"));
    }
}