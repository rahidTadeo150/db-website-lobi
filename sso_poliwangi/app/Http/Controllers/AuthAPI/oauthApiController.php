<?php

namespace App\Http\Controllers\AuthAPI;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Passport\RefreshToken;

class oauthApiController extends Controller
{
    public function logoutme(Request $request) 
    {
        $user = $request->user();
        $accessToken = $user->token();
        RefreshToken::where('access_token_id', $accessToken->id)->delete();
        $accessToken->delete();
    }
}
