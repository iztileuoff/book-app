<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Book\CreateBookRequest;
use App\Http\Requests\Api\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if($title = $request->input('title')){
            $query->whereRaw("title LIKE '%" . $title . "%'");
        }
        if($description = $request->input('description')){
            $query->whereRaw("description LIKE '%" . $description . "%'");
        }
        if($author = $request->input('author')){
            $query->whereRaw("author LIKE '%" . $author . "%'");
        }
        if($gener_id = $request->input('gener_id')){
            $query->where("gener_id", $gener_id);
        }
        $query->orderByDesc('id');
        
        $books = $request->input('limit') ? $query->paginate($request->input('limit')) : $query->paginate();
        
        return new BookCollection($books);
    }

    public function store(CreateBookRequest $request)
    {
        $book = Book::create($request->validated());

        if($file = $request->file('image'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            $file->storeAs('public/books/', $filename);

            $img = new Image;
            $img->url = $filename;
            $book->image()->save($img);
        }

        return response()->json(['message' => 'Success created'], 201);
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return response()->json(['message' => 'Success updated'], 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Success deleted'], 200);
    }
}
