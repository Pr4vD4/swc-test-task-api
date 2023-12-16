<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Http\Request;


class Unauthenticated extends Exception
{
    public function render(Request $request)
    {
        return response()->json(new ErrorResource('Unauthenticated'), 401);
    }
}
