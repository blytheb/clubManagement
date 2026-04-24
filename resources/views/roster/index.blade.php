<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>

    <x-content>
        <h2>Roster</h2>

        @if($team->users->isEmpty())
        <p>NO PLAYERS ON THIS ROSTER</p>
        @endif

        @foreach ($team->users as $user)
        <div>
            {{ $user->name }}
        </div>
        <div>
            {{ $user->email }}
        </div>
        @endforeach

        <hr>

        {{-- <button><a href="{{ route('teams.roster.add', $team) }}">Add Player</a></button> --}}


    </x-content>
</x-app-layout>
