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
use Illuminate\Pagination\LengthAwarePaginator;

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
        $direction = data_get($input, 'sortDirection') ?? 'ASC';
        $page = data_get($input, 'page') ?? 1;
        $query = $this->book->query();

        if (in_array($column, ['id', 'published_year'])) {
            $query->orderBy($column, $direction);
        }

        $books = $query->get();

        if (in_array($column, ['avg_review'])) {
            $callback = function ($book) {
                return $book->reviews->avg('review');
            };
            switch ($direction) {
                case 'ASC':
                    $books = $books->sortBy($callback);
                    break;
                case 'DESC':
                    $books = $books->sortByDesc($callback);
                    break;
            }
        }

        $perPage = 5;
        $items = $books->forPage($page, $perPage);
        $total = $books->count();
        $options = [
            'path' => url()->current(),
            'query' => request()->query(),
        ];

        $resource = new LengthAwarePaginator($items, $total, $perPage, null, $options);

        return BookResource::collection($resource);
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
