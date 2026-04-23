<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Teams
        </h2>
    </x-slot>

    <a href="{{ route('teams.create') }}">Create Team</a>

    @foreach($teams as $team)
        <div>
            {{ $team->name }}
{{--
            <a href="{{ route('teams.edit', $team) }}">Edit</a>

            <form method="POST" action="{{ route('teams.destroy', $team) }}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form> --}}
        </div>
    @endforeach
</x-app-layout>
