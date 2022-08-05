<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserTokenResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return UserTokenResource
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): UserTokenResource
    {
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            return new UserTokenResource($user);
        }

        throw new AuthenticationException();
    }

    /**
     * @param RegisterRequest $request
     * @return UserTokenResource
     */
    public function register(RegisterRequest $request): UserTokenResource
    {
        $user = new User();

        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->save();

        return new UserTokenResource($user);
    }
}
