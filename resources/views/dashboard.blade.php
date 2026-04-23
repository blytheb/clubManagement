<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-content>
        @role('admin')
            <div class="p-4 bg-white shadow">
                <h2>Admin Panel</h2>
            </div>
        @endrole
        @role('player')
            <div class="p-4 bg-white shadow">
                <h2>Player Panel</h2>
            </div>
        @endrole
    </x-content>

</x-app-layout>
