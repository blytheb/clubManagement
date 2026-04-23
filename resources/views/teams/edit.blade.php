<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit a Team
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('teams.update', $team) }}">
        @csrf
        @method('PUT')

        <label> Team Name :</label>
        <input name='name' value="{{ $team->name }}" />
        <button>Update</button>
    </form>

</x-app-layout>
