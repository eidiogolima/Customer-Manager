<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAutenticateController extends Controller
{
    public function pull()
    {
        $users = User::all();
        return response()->json(['users' => $users, 'Autenticado' => Auth::user()]);
    }
}
