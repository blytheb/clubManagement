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
        @endforeach

        <hr>

        <h3>Add Player</h3>

        <form method='POST' action="{{ route('teams.roster.add', $team) }}">
            @csrf

            <input type="number" name="user_id" placeholder="User ID">
            <button> Add </button>
        </form>

    </x-content>
</x-app-layout>
