<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|unique:users,login',
            'password' => 'required|confirmed',
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'date'
        ]);
        if ($validator->fails()) {
            return response()->json(new ErrorResource($validator->errors()), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]
        ));

        $user->token = JWTAuth::fromUser($user);

        return response()->json(new UserResource($user));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(new ErrorResource($validator->errors()), 400);
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(new ErrorResource('Unauthorized'), 401);
        }
        return response()->json([
            'error' => null,
            'result' => [
                'token' => $token
            ]
        ]);

    }

    public function profile(Request $request)
    {
        return response()->json(auth()->user());
    }

}
