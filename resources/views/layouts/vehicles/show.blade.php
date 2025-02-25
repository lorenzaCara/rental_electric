@extends('layouts.app')

@section('title', 'Vehicle')

@section('content')
    <div class="p-4 border rounded-lg">
        <div class="font-semibold">Model: <span class="text-blue-500">{{ $vehicle->model }}</span></div>
        <div>Type: {{ $vehicle->type }}</div>
        <div>Battery capacity: {{ $vehicle->battery_capacity }}</div>
        <div>Status: {{ $vehicle->status }}</div>
        <div>Hourly rate: {{ $vehicle->hourly_rate }}</div>
        <div>Created at: {{ $vehicle->created_at }}</div>
        <div>Updated at: {{ $vehicle->updated_at }}</div>
    </div>
@endsection
