<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        return [
            'total_users' => User::count(),
            'users_by_city' => User::selectRaw('city, count(*) as total')->groupBy('city')->get(),
        ];
    }
}
