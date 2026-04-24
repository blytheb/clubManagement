<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a new Event
        </h2>
    </x-slot>

    <x-content><h2 class="mt-6 font-bold">Create Event</h2>


<form method="POST" action="{{ route('events.store') }}">
    @csrf

    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

    <input type="text" name="name" placeholder="Event name" required>

    <input type="datetime-local" name="eventDate" required>

    @if(isset($team))
        <input type="hidden" name="team_id" value="{{ $team->id }}">
    @else
        <select name="team_id">
            @foreach($teams as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
        </select>
    @endif

    <button>Create Event</button>
</form>
    </x-content>

</x-app-layout>
