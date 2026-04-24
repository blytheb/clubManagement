<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Player to  {{$team->name }}
        </h2>
    </x-slot>
    <x-content>
        <h1>Add a existing player</h1>

        <form method='POST' action="{{ route('teams.roster.storePlayer', $team) }}">
            @csrf

            <input type="number" name="user_id" placeholder="User ID">
            <button> Add </button>
        </form>


        <h1>or Create a new Player Profile</h1>

        <form method='POST' action="{{ route('teams.roster.storePlayer', $team) }}">
            @csrf

            <input type="text" name="name" placeholder="Player Name" required>
            <input type="email" name="email" placeholder="Player Email" required >
            <button type="submit"> Create & Add </button>
        </form>

    </x-content>
</x-app-layout>
