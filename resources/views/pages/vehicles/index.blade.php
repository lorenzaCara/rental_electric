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
    @if (!$newVehicles->isEmpty())
        <h2 class="flex items-center gap-2 mb-4 text-xl font-medium">
            <div class="w-1 h-4 bg-orange-500"></div> New
        </h2>
        <div class="grid gap-4 pb-5 mb-5 border-b md:grid-cols-3">
            @foreach ($newVehicles as $vehicle)
                @include('includes.vehicle-card', ['type' => 'new'])
            @endforeach
        </div>
    @endif
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($vehicles as $vehicle)
            @include('includes.vehicle-card')
        @endforeach
    </div>
    @if ($vehicles->isEmpty())
        <div class="w-full p-4 mt-4 border border-dashed rounded-xl">
            Nessun veicolo registrato
        </div>
    @endif
@endsection
