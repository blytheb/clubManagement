<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Teams
            </h2>
            <x-primary-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <a href="{{ route('teams.create') }}"  class="inline-flex items-center gap-2">
                    <x-heroicon-s-plus class="w-4 h-4"/>
                    New Team
                </a>
            </x-primary-button>
        </div>

    </x-slot>

    <x-content>
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

</x-app-layout>
