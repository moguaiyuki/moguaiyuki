<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookReview;
use App\Tag;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    private $perPage = 20;

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
        $books = Book::orderBy('id', 'desc')->paginate($this->perPage);
        $tags = $this->getBookTags();

        return view('front.books.index', compact('books', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $review = BookReview::whereSlug($slug)->first();
        $tags = $this->getBookTags();

        return view('front.books.detail', compact('review', 'tags'));
    }

    /**
     * タグに紐づいた投稿を取得
     */
    public function searchTag($id)
    {
        $search_tag = Tag::findOrFail($id);
        $books = $search_tag->books()->orderBy('id', 'desc')->paginate($this->perPage);

        return view('front.books.index', compact('books', 'search_tag'));
    }

    /**
     * プログラミングのタグを取得
     */
    private function getBookTags()
    {
        $tags = Tag::with('books')->get();
        $books_tags = [];
        foreach ($tags as $tag) {
            if (($tag->books->isNotEmpty())) {
                $books_tags["$tag->id"] = $tag->name;
            }
        }
        return $books_tags;
    }
}
