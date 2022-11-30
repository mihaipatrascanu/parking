<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;

class LoginController extends Controller
{
    use ApiResponses;

    /**
     * Log a user into the app
     *
     * @bodyParam email string required User email address. Example: mihai@mihai.com
     * @bodyParam password string required Users password. Example: password
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request)
    {

        $request->validated($request->only(['email', 'password']));

        if(!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('','Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user'          => $user,
            'token'         => $user->createToken('API Token for '. $user->name)->plainTextToken,
            'token_type'    => 'Bearer'
        ]);

    }

}
