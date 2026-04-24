<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamRosterController extends Controller
{
    public function index(Team $team){
        $team->load(['users', 'events']);
        return view('roster.index', compact('team'));
    }

    //display route to build roster
    public function createPlayer(Team $team)
    {
        return view('roster.create', compact('team'));
    }

    //backend to store selected player to roster
    public function storePlayer(Request $request, Team $team)
    {
        if ($request->user_id){
            $user= User::findOrFail($request->user_id);
        }

        else {
            $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users,email']
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password123'),
            ]);
        }

        $role = Role::where('name', 'player')->first();

        $user->roles()->syncWithoutDetaching([$role->id]);

        $team->users()->syncWithoutDetaching([$user->id]);

        return redirect()->route('roster.index', $team);
    }


    public function removePlayer(Request $request, Team $team)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id']
        ]);

        $team->users()->detach($request->user_id);

        return redirect()->route('roster.index', $team);
    }
}
