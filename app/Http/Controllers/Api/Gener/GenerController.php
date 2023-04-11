<?php

namespace App\Http\Controllers\Api\Gener;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gener\CreateGenerRequest;
use App\Http\Requests\Api\Gener\UpdateGenerRequest;
use App\Http\Resources\Gener\GenerCollection;
use App\Http\Resources\Gener\GenerResource;
use App\Models\Gener;
use Illuminate\Http\Request;

class GenerController extends Controller
{
    public function index(Request $request)
    {
        $geners = Gener::get();

        return new GenerCollection($geners);
    }

    public function store(CreateGenerRequest $request, Gener $gener)
    {
        $gener->create($request->validated());

        return response()->json(['message' => 'Success created'], 201);
    }

    public function show(Gener $gener)
    {
        return new GenerResource($gener);
    }

    public function update(UpdateGenerRequest $request, Gener $gener)
    {
        $gener->update($request->validated());

        return response()->json(['message' => 'Success updated'], 200);
    }

    public function destroy(Gener $gener)
    {
        $gener->delete();

        return response()->json(['message' => 'Success deleted'], 200);
    }
}
