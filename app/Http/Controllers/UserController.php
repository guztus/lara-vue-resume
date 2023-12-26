<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth("sanctum")->check()) {
            return response()->json(auth("sanctum")->user());
        }
    }
}
