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

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Player Name</th>
                    <th class="p-2 text-left">Player Email</th>
                    <th class="p-2 text-left">Options</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($team->users as $user)
                    <tr class="border-t">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2 ">
                            {{-- <a href="{{ route('roster.index', $team) }}" class="text-blue-400">View</a>
                            <a href="{{ route('teams.edit', $team) }}" class="text-blue-400">Edit</a> --}}

                            <form action="{{ route('teams.destroy', $team) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Are you sure?')" class="text-red-500">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <button><a href="{{ route('roster.create', $team) }}">Add Player</a></button>


    </x-content>
</x-app-layout>
