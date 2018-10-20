<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $token = Auth::user()->createToken(config('app.name'))->accessToken;

            return response()->json([
                'data' => $token,
            ], 200);

        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    /**
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {

        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $data['token'] = $user->createToken(config('app.name'))->accessToken;
        $data['name'] = $user->name;

        return response()->json($data, 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}