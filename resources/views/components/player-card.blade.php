@props(['user', 'team'])

<div class="bg-white border rounded-xl p-4 shadow-sm hover:shadow-md transition text-center">

    <!-- AVATAR -->
    <div class="relative mx-auto w-fit">
        <img
            src="https://robohash.org/{{ urlencode($user->email ?? $user->id) }}?size=150x150"
            class="w-20 h-20 rounded-full border mx-auto"
        >

        <!-- JERSEY NUMBER -->
        <div class="absolute -bottom-1 -right-1 bg-blue-600 text-white text-xs px-2 py-1 rounded-full font-bold">
            #{{ $user->id ?? '--' }}
        </div>
    </div>

    <!-- NAME -->
    <div class="mt-3 font-bold text-lg text-gray-800">
        {{ $user->name }}
    </div>

    <!-- STATUS -->
    @php
        $status = $user->pivot->status ?? 'active';
    @endphp

    <div class="mt-1">
        @if($status === 'active')
            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">
                Active
            </span>
        @elseif($status === 'injured')
            <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">
                Injured
            </span>
        @elseif($status === 'bench')
            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                Bench
            </span>
        @else
            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                {{ ucfirst($status) }}
            </span>
        @endif
    </div>

    <!-- ACTIONS -->
    <div class="mt-4 flex justify-center gap-3">

        <!-- Remove -->
        <form method="POST" action="{{ route('roster.removePlayer', $team) }}">
            @csrf
            @method('DELETE')

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <button class="text-red-500 hover:text-red-700">
                <x-heroicon-o-trash class="w-5 h-5" />
            </button>
        </form>

    </div>
</div>