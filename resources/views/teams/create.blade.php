<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a Team
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('teams.store') }}">
        @csrf
        <label> Team Name :</label>
        <input name='name' placeholder="team name" />
        <button>Create</button>
    </form>

</x-app-layout>
