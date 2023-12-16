<?php

namespace App\Http\Middleware;

use App\Exceptions\Unauthenticated;
use App\Http\Resources\ErrorResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    /**
     * @throws Unauthenticated
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new Unauthenticated();

    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
