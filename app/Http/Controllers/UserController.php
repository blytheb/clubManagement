<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;

abstract class UserController
{
    public function search(Request $request){
        return User::where('name', 'like', '%{$request->q}%')
        ->limit(10)
        ->get();
    }
}
