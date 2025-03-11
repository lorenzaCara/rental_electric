@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
    <div class="flex justify-between">
        <h1 class="mb-4 text-2xl font-semibold">Veicoli</h1>
        <a class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-blue-500 hover:bg-blue-700 rounded-xl"
            href="{{ route('vehicles.create') }}">
            <x-lucide-plus class="size-4 " />Aggiungi veicolo
        </a>
    </div>
    @include('includes.success-alert')
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($vehicles as $vehicle)
            <div class="p-4 border rounded-lg">
                <div class="font-semibold">Modello: <span class="text-blue-500">{{ $vehicle->model }}</span></div>
                <div>Tipo: {{ $vehicle->type }}</div>
                <div>Capacità batteria: {{ $vehicle->battery_capacity }}</div>
                <div>Stato: {{ $vehicle->status }}</div>
                <div>Tariffa oraria: {{ $vehicle->hourly_rate }}</div>
                <div>Creato il: {{ $vehicle->created_at }}</div>
                <div class="mb-2">Aggiornato il: {{ $vehicle->updated_at }}</div>
                <span>Tags</span>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach ($vehicle->tags as $tag)
                        <div class="px-3 py-1 bg-gray-600 rounded-xl">
                            {{ $tag->name }}
                        </div>
                    @endforeach
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('vehicles.show', $vehicle->id) }}"
                        class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-blue-500 hover:bg-blue-700 rounded-xl">
                        <x-lucide-eye class="size-4" />Mostra
                    </a>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                        class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-amber-500 hover:bg-amber-700 rounded-xl">
                        <x-lucide-pencil class="size-4" />Modifica
                    </a>
                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-red-500 hover:bg-red-700 rounded-xl">
                            <x-lucide-trash class="size-4" />
                            Elimina
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($vehicles) === 0)
        <div class="w-full p-4 mt-4 border border-dashed rounded-xl">
            Nessun veicolo registrato
        </div>
    @endif
@endsection
