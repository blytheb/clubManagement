<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Player to {{ $team->name }}
        </h2>
    </x-slot>

    <x-content>
        <hr>

        {{-- CREATE PLAYER --}}
        <h1>Create new player profile</h1>

        <form method="POST" action="{{ route('roster.storePlayer', $team) }}">
            @csrf

            <input type="text" name="name" placeholder="Player Name" required>
            <input type="email" name="email" placeholder="Player Email" required>

            <button type="submit">Create & Add</button>
        </form>

    </x-content>
</x-app-layout>

<script>
    function searchUsers() {
        return {
            query: '',
            results: [],
            open: false,

            search() {
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
