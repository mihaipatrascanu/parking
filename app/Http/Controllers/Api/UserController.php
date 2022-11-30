<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    use ApiResponses;

    public function index(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
    
    /**
     * Logout a user from the app
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
       
       Auth::user()->currentAccessToken()->delete();

       return $this->success([
            'message' => 'You have been logout'
       ]);
    }

}
