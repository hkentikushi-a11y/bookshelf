<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if (is_null($user->postcode) && is_null($user->address)) {
            return redirect('/mypage/profile');
        }

        return redirect('/');
    }
}
