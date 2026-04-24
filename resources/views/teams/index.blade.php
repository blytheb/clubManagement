<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Teams
        </h2>
    </x-slot>

    <x-content>
        <a href="{{ route('teams.create') }}">Create Team</a>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Team Name</th>
                    <th class="p-2 text-left">Options</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($teams as $team)
                    <tr class="border-t">
                        <td class="p-2">{{ $team->name }}</td>
                        <td class="p-2 ">
                            <a href="{{ route('roster.index', $team) }}" class="text-blue-400">View</a>
                            <a href="{{ route('teams.edit', $team) }}" class="text-blue-400">Edit</a>

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
    </x-content>

    <x-content>
        <h2 class="text-lg font-bold mt-6">Events</h2>

        @if ($team->events->isEmpty())
            <p class="text-gray-500">No events for this team</p>
        @endif

        @foreach ($team->events as $event)
            <div class="p-3 border-b">
                <div class="font-semibold">
                    {{ $event->name }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ $event->event_date }}
                </div>
            </div>
        @endforeach
    </x-content>

</x-app-layout>
