<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\BookReview;
use App\Http\Requests\PostBookRequest;
use App\Http\Requests\PostBookReviewRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookReviewResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return BookResource::collection();
    }

    public function store(PostBookRequest $request)
    {
        $book = new Book();

        // @TODO implement

        return new BookResource($book);
    }

}
