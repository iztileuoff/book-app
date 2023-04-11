<?php

namespace App\Http\Controllers\Api\Quote;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\CreateQuoteRequest;
use App\Http\Requests\Api\Quote\UpdateQuoteRequest;
use App\Http\Resources\Quote\QuoteCollection;
use App\Http\Resources\Quote\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Quote::query();

        if($text = $request->input('text')){
            $query->whereRaw("text LIKE '%" . $text . "%'");
        }
        if($author = $request->input('author')){
            $query->whereRaw("author LIKE '%" . $author . "%'");
        }
        $query->orderByDesc('id');
        
        $quotes = $request->input('limit') ? $query->paginate($request->input('limit')) : $query->paginate();

        return new QuoteCollection($quotes);
    }

    public function store(CreateQuoteRequest $request, Quote $quote)
    {
        $quote->create($request->validated());

        return response()->json(['message' => 'Success created'], 201);
    }

    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }

    public function update(UpdateQuoteRequest $request, Quote $quote)
    {
        $quote->update($request->validated());

        return response()->json(['message' => 'Success updated'], 200);
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        return response()->json(['message' => 'Success deleted'], 200);
    }
}
