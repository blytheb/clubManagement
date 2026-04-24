<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Events
            </h2>
            <x-primary-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <a href="{{ route('events.create') }}"  class="inline-flex items-center gap-2">
                    <x-heroicon-s-plus class="w-4 h-4"/>
                    New Event
                </a>
            </x-primary-button>
        </div>
    </x-slot>



    <x-content>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Event Name</th>
                    <th class="p-2 text-left">Team</th>
                    <th class="p-2 text-left">Attendance</th>
                    <th class="p-2 text-left">Options</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($events as $event)
                    <tr class="border-t">
                        <td class="p-2">{{ $event->eventDate }}</td>
                        <td class="p-2">{{ $event->name }}</td>
                        <td class="p-2">{{ $event->team->name ?? 'No Team' }}</td>
                        <td class="p-2">{{ $event->users->count() }}</td>

                        <td class="p-2 flex gap-4">
                            <a href="{{ route('roster.index', $event) }}" class="text-blue-400">
                                <x-heroicon-s-eye class="w-4 h-4"/>
                            </a>
                            <a href="{{ route('teams.edit', $event) }}" class="text-blue-400">
                                <x-heroicon-s-pencil class="w-4 h-4"/>
                            </a>

                            <form action="{{ route('teams.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Are you sure?')" class="text-red-500">
                                    <x-heroicon-s-trash class="w-4 h-4"/>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <form method="POST" action="{{ route('events.mark', $event) }}">
            @csrf

            @foreach ($event->users as $user)
                <div>
                    <span>{{ $user->name }}</span>

                    <input
                        type="checkbox"
                        name="attendance[{{ $user->id }}]"
                        value="1"
                        {{ $user->pivot->attended ? 'checked' : '' }}
                    >
                </div>
            @endforeach

            <button>Save Attendance</button>
        </form> --}}
    </x-content>



</x-app-layout>



