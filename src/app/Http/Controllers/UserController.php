<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
