@extends('layouts.app')

@section('title', 'Vehicle')

@section('content')
    <h1 class="flex items-center gap-2 mb-4 text-2xl font-semibold">
        <a href="{{ route('vehicles.index') }}" class="font-normal">Veicoli</a>
        <x-lucide-chevron-right class="size-4" />{{ $vehicle->model }}
    </h1>
    <div class="p-4 border rounded-lg">
        <div>Tipo: {{ $vehicle->type }}</div>
        <div>Capacità batteria: {{ $vehicle->battery_capacity }}</div>
        <div>Stato: {{ $vehicle->status }}</div>
        <div>Tariffa oraria: {{ $vehicle->hourly_rate }}</div>
        <div>Creato il: {{ $vehicle->created_at }}</div>
        <div>Aggiornato il: {{ $vehicle->updated_at }}</div>
    </div>
@endsection
