<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>

    <x-content>
        <h2>Roster</h2>

        <div
            x-data="userSearch({{ $team->id }})"
            class="relative w-96"
            @click.outside="open = false"
        >

            <!-- SEARCH INPUT -->
            <input
                type="text"
                x-model="query"
                @input.debounce.300ms="search"
                placeholder="Search players..."
                class="border p-2 w-full"
            >

            <!-- DROPDOWN -->
            <div
                x-show="open"
                class="class="absolute bg-white border w-full mt-1 z-50 max-h-60 overflow-y-auto"
            >

                <template x-for="user in results" :key="user.id">
                    <div class="p-2 hover:bg-gray-100 flex justify-between">

                        <span x-text="user.name"></span>
                        {{-- IF NOT IN TEAM --}}
                        <template x-if="!teamUserIds.includes(user.id)">
                            <form method="POST" action="{{ route('roster.storePlayer', $team) }}">
                                @csrf

                                <input type="hidden" name="user_id" :value="user.id">

                                <button class="text-blue-600">
                                    Add
                                </button>
                            </form>
                        </template>

                        {{-- IF ALREADY IN TEAM --}}
                        <template x-if="teamUserIds.includes(user.id)">
                            <span class="text-gray-400 tesxt-sm">
                                Already in team
                            </span>
                        </template>
                    </div>
                </template>

                <!-- NO RESULTS -->
                <div
                    x-show="results.length === 0 && query.length > 2"
                    class="p-2 text-gray-500"
                >
                    No users found
                </div>
            </div>
        </div>

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

<script>
    window.teamUserIds = @json($team->users->pluck('id'));
    function userSearch(teamId) {
        return {
            teamId: teamId,
            query: '',
            results: [],
            open: false,

            search() {
                console.log(this.query);
                if (this.query.length < 2) {
                    this.results = [];
                    this.open = false;
                    return;
                }

                fetch(`/users/search?q=${this.query}`)
                    .then(res => res.json())
                    .then(data => {
                        this.results = data;
                        this.open = true;
                    });
            }
        }
    }
    </script>
