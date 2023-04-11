<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Image;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        $input = $request -> validated();
        if(!Auth::attempt($input))
        {
            return response()->json(['message' => 'Unauthorized!'], 401);
        }
        
        $now = Carbon::now();
        $old_day = $now->subDays(3);
        $old_token = auth()->user()->tokens()->where('last_used_at', '<=', $old_day)->get()->first();

        if (!empty($old_token))
        {
            $old_token->delete();
        }

        $tokenResult = Auth::user()->createToken('token')->plainTextToken;
        
        return response()->json([
            'data' => [
                'user' => new UserResource(auth()->user()),
                'token' => $tokenResult
        ]]);
    }

    public function registration(RegistrationRequest $request)
    {
        $input = $request->validated();

        $input['password'] = Hash::make($input['password']);
        $user = new User($input);
        $user->save();

        if($file = $request->file('image'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            $file->storeAs('public/avatars/', $filename);

            $img = new Image;
            $img->url = $filename;
            $user->image()->save($img);
        }

        $tokenResult = $user->createToken('token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => new UserResource($user),
                'token' => $tokenResult
        ]]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'you are successfully logout']);
    }

    public function check(Request $request)
    {
        return response([
            'message' => 'success',
            'data' => [
                'user' => new UserResource(auth()->user()),
            ]
        ]);
    }
}
