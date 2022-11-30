<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;

class RegisterController extends Controller
{
    use ApiResponses;
    
    /**
     * Create new user
     *
     * @bodyParam name string required User name. Example: Mihai
     * @bodyParam email string required User email address. Example: mihai@mihai.com
     * @bodyParam password string required User password. Example: password
     * @bodyParam password_confirmation string required User password_confirmation. Example: password
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request)
    {
        $request->validated($request->only(['name', 'email', 'password']));

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        return $this->success([
            'user'          => $user,
            'token'         => $user->createToken('API Token for '. $user->name)->plainTextToken,
            'token_type'    => 'Bearer'
        ]);
    }
}
