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
        $team->load('users');
        return view('roster.index', compact('team'));
    }

    //display route to build roster
    public function createRoster(Team $team)
    {
        return view('teams.roster.create', compact('team'));
    }

    //backend to store selected player to roster
    public function storePlayer(Request $request, Team $team)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $user = User::findOrFail($request->user_id);

        if(!$user->hasRole('player')) {
            return back()->with('error', 'User is not a player.');
        }

        $team->users()->syncWithoutDetaching([$user->id]);

        return back()->with('success', 'Player added to roster');
    }

    public function createPlayer(Request $request, Team $team)
    {
        // validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // 1. Find existing user OR create new one
        $user = User::firstOrCreate(
            ['email' => $request->email], // lookup
            [
                'name' => $request->name,
                'password' => Hash::make('default123') // or generate random
            ]
        );

        // 2. Assign "player" role
        $playerRole = Role::where('name', 'player')->first();

        if (!$user->roles->contains($playerRole->id)) {
            $user->roles()->attach($playerRole->id);
        }

        // 3. Attach user to team (no duplicates)
        $team->users()->syncWithoutDetaching([$user->id]);

        return back()->with('success', 'Player added to team');

    }

    // public function removePlayer(Team $team, User $user)
    // {
    //     $team->users()->detach($user->id);

    //     return back()->with('success', 'Player removed from roster');
    // }
}
