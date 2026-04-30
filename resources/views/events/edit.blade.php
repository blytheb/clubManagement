<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit this Event
        </h2>
    </x-slot>

    <x-content><h2 class="mt-6 font-bold">Edit Event</h2>
        <form method="POST" action="{{ route('events.update', $event) }}">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

            <input type="text" name="name" value="{{ $event->name }}" required>

            <input type="datetime-local" name="eventDate" value="{{ $event->eventDate }}" required>

            @if(isset($team))
                <input type="hidden" name="team_id" value="{{ $team->id }}">
            @else
                <select name="team_id">
                    @foreach($teams as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            @endif

            <button>Update Event</button>
        </form>
    </x-content>

</x-app-layout>
