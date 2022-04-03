<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\BookReview;
use App\Http\Requests\GetBookRequest;
use App\Http\Requests\PostBookRequest;
use App\Http\Requests\PostBookReviewRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookReviewResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index(GetBookRequest $request)
    {
        $input = $request->input();
        $column = data_get($input, 'sortColumn');
        $direction = data_get($input, 'sortDirection');

        $query = $this->book->query();

        if ($column !== null && $direction !== null) {
            $query->orderBy($column, $direction);
        }

        $books = $query->paginate(5);

        return BookResource::collection($books);
    }

    public function store(PostBookRequest $request)
    {
        $book = new Book();

        // @TODO implement
        $input = $request->input();

        $book = $book->create($input);

        $authors = array_map(function ($id) {
            return [
                'author_id' => $id,
            ];
        }, $input['authors']);

        $book->bookAuthors()->createMany($authors);

        return new BookResource($book);
    }

}
