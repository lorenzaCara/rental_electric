@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Vehicles</h1>
    <div class="space-y-4">
        @foreach ($vehicles as $vehicle)
            <div class="p-4 border rounded-lg">
                <div class="font-semibold">Model: <span class="text-blue-500">{{ $vehicle->model }}</span></div>
                <div>Type: {{ $vehicle->type }}</div>
                <div>Battery capacity: {{ $vehicle->battery_capacity }}</div>
                <div>Status: {{ $vehicle->status }}</div>
                <div>Hourly rate: {{ $vehicle->hourly_rate }}</div>
                <div>Created at: {{ $vehicle->created_at }}</div>
                <div>Updated at: {{ $vehicle->updated_at }}</div>
                <a href="/vehicles/{{ $vehicle->id }}" class="text-blue-500 mt-2 inline-block">Details</a>
            </div>
        @endforeach
    </div>
@endsection
