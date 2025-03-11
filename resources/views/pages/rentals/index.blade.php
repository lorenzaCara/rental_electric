@extends('layouts.app')

@section('title', 'Rentals')

@section('content')

    <div class="flex justify-between">
        <h1 class="mb-4 text-2xl font-semibold">Noleggi</h1>
        <a class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-blue-500 hover:bg-blue-700 rounded-xl"
            href="{{ route('rentals.create') }}">
            <x-lucide-plus class="size-4 " />Aggiungi noleggio
        </a>
    </div>
    @include('includes.success-alert')
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($rentals as $rental)
            <div class="p-4 border rounded-lg">
                <div class="font-semibold">Vehicle: <span class="text-blue-500">{{ $rental->vehicle->model }}</span></div>
                <div>Customer: {{ $rental->customer->name }}</div>
                <div>Start Time: {{ $rental->start_time }}</div>
                <div>End Time: {{ $rental->end_time ?? 'Ongoing' }}</div>
                <div>Total Cost: ${{ $rental->total_cost }}</div>
                <div>Status: {{ $rental->status }}</div>
                <div>Created at: {{ $rental->created_at }}</div>
                <div>Updated at: {{ $rental->updated_at }}</div>
                @if ($rental->status !== 'completed')
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('rentals.complete', $rental->id) }}"
                            class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-green-500 hover:bg-green-700 rounded-xl">
                            <x-lucide-check class="size-4" />Completa noleggio
                        </a>
                    </div>
                @else
                    <div
                        class="flex items-center justify-center h-10 gap-2 p-4 mt-4 text-white transition-colors bg-green-500/10 rounded-xl">
                        <x-lucide-check class="size-4" />Noleggio completato
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if (count($rentals) === 0)
        <div class="w-full p-4 mt-4 border border-dashed rounded-xl">
            Nessun noleggio registrato
        </div>
    @endif
@endsection
