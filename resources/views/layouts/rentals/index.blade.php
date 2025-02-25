@extends('layouts.app')

@section('title', 'Rentals')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Rentals</h1>
    <div class="space-y-4">
        @foreach ($rentals as $rental)
            <div class="p-4 border rounded-lg">
                <div class="font-semibold">Vehicle ID: <span class="text-blue-500">{{ $rental->vehicle_id }}</span></div>
                <div>Customer ID: {{ $rental->customer_id }}</div>
                <div>Start Time: {{ $rental->start_time }}</div>
                <div>End Time: {{ $rental->end_time ?? 'Ongoing' }}</div>
                <div>Total Cost: ${{ $rental->total_cost }}</div>
                <div>Status: {{ $rental->status }}</div>
                <div>Created at: {{ $rental->created_at }}</div>
                <div>Updated at: {{ $rental->updated_at }}</div>
            </div>
        @endforeach
    </div>
@endsection
