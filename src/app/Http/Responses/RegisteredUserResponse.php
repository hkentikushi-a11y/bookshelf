<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisteredUserResponse as RegisteredUserResponseContract;

class RegisteredUserResponse implements RegisteredUserResponseContract
{
    public function toResponse($request)
    {
        return redirect('/login');
    }
}
