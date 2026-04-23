<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamRosterController extends Controller
{
    public function addPlayer(Request $request, Team $team)
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

    public function removePlayer(Team $team, User $user)
    {
        $team->users()->detach($user->id);

        return back()->with('success', 'Player removed from roster');
    }
}
