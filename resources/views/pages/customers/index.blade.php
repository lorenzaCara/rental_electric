@extends('layouts.app')

@section('title', 'Customers')

@section('content')

    <div class="flex justify-between">
        <h1 class="mb-4 text-2xl font-semibold">Clienti</h1>
        <a class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-blue-500 hover:bg-blue-700 rounded-xl"
            href="{{ route('customers.create') }}">
            <x-lucide-plus class="size-4 " />Aggiungi cliente
        </a>
    </div>
    @include('includes.success-alert')
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($customers as $customer)
            <div class="p-4 border rounded-lg">
                <div class="font-semibold">Name: <span class="text-blue-500">{{ $customer->name }}</span></div>
                <div>Email: {{ $customer->email }}</div>
                <div>Phone: {{ $customer->phone }}</div>
                <div>Created at: {{ $customer->created_at }}</div>
                <div>Updated at: {{ $customer->updated_at }}</div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('customers.show', ['customer' => $customer->id]) }}"
                        class="flex items-center justify-center h-10 gap-2 p-4 text-white transition-colors bg-blue-500 hover:bg-blue-700 rounded-xl">
                        <x-lucide-eye class="size-4" />Mostra
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($customers) === 0)
        <div class="w-full p-4 mt-4 border border-dashed rounded-xl">
            Nessun cliente registrato
        </div>
    @endif
@endsection
