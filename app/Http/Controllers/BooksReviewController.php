<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\BookReview;
use App\Http\Requests\PostBookRequest;
use App\Http\Requests\PostBookReviewRequest;
use App\Http\Requests\DeleteBookReviewRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookReviewResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksReviewController extends Controller
{
    protected $bookReview;

    public function __construct(BookReview $bookReview)
    {
        $this->bookReview = $bookReview;
    }

    public function store(int $bookId, PostBookReviewRequest $request)
    {
        $bookReview = new BookReview();

        // @TODO implement
        $input = $request->input();

        data_set($input, 'user_id', 2);
        data_set($input, 'book_id', $bookId);

        $bookReview = $bookReview->create($input);

        return new BookReviewResource($bookReview);
    }

    public function destroy(int $bookId, int $reviewId, DeleteBookReviewRequest $request)
    {
        // @TODO implement
        $this->bookReview
            ->where([
                ['id', '=', $reviewId],
                ['book_id', '=', $bookId],
            ])
            ->delete();

        return response([], 204);
    }
}
