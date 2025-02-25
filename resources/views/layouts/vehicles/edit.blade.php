@extends('layouts.app')

@section('title', 'Modifica Veicolo')

@section('content')
    <form action="{{ route('vehicles.update', ['vehicle' => $vehicle->id]) }}" method="post"
        class="flex flex-col max-w-xs gap-4 px-4 mx-auto">
        <h1 class="text-xl">Modifica utente</h1>
        @method('PUT')
        @csrf
        <h3 class="text-sm">Modifica modello</h3>
        <input class="px-4 py-2 bg-gray-800 border border-gray-500 rounded-lg placeholder:text-gray-500" placeholder="Name"
            type="text" name="model" value="{{ old('model', $vehicle->model) }}">
        <h3 class="text-sm">Modifica tipo</h3>
        <select class="px-4 py-2 bg-gray-800 border border-gray-500 rounded-lg text-gray-300" name="type" required>
            <option value="" disabled selected>Seleziona un tipo</option>
            <option value="car" {{ old('type', $vehicle->type) == 'car' ? 'selected' : '' }}>Car</option>
            <option value="scooter" {{ old('type', $vehicle->type) == 'scooter' ? 'selected' : '' }}>Scooter</option>
            <option value="bike" {{ old('type', $vehicle->type) == 'bike' ? 'selected' : '' }}>Bike</option>
        </select>
        <h3 class="text-sm">Modifica capacità batteria</h3>
        <input class="px-4 py-2 bg-gray-800 border border-gray-500 rounded-lg placeholder:text-gray-500"
            placeholder="Battery capacity" type="number" name="battery_capacity"
            value="{{ old('battery_capacity', $vehicle->battery_capacity) }}" required>
        <h3 class="text-sm">Modifica disponibilità</h3>
        <select class="px-4 py-2 bg-gray-800 border border-gray-500 rounded-lg text-gray-300" name="status" required>
            <option value="" disabled selected>Seleziona uno stato</option>
            <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available
            </option>
            <option value="rented" {{ old('status', $vehicle->status) == 'rented' ? 'selected' : '' }}>Rented</option>
            <option value="maintenance" {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>Maintenance
            </option>
        </select>
        <h3 class="text-sm">Modifica tariffa oraria</h3>
        <input class="px-4 py-2 bg-gray-800 border border-gray-500 rounded-lg placeholder:text-gray-500"
            placeholder="Hourly rate" type="number" name="hourly_rate"
            value="{{ old('hourly_rate', $vehicle->hourly_rate) }}" required>
        <button class="px-4 py-2 text-white bg-blue-500 rounded-lg" type="submit">Invia</button>
    </form>
    @if ($errors->any())
        <div class="text-red-500 bg-red-500/30">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
