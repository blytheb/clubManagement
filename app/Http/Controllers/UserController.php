<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request){
        $q = $request->input('q');

        if (!$q) {
            return response()->json();
        }
        return User::where('name', 'like', "%{$q}%")
        ->orWhere('email', 'like', "%{$q}%")
        ->limit(10)
        ->get();
    }
}
