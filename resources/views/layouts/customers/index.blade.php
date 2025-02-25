@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Customers</h1>
    <div class="space-y-4">
        @foreach ($customers as $customer)
            <div class="p-4 border rounded-lg">
                <div class="font-semibold">Name: <span class="text-blue-500">{{ $customer->name }}</span></div>
                <div>Email: {{ $customer->email }}</div>
                <div>Phone: {{ $customer->phone }}</div>
                <div>Created at: {{ $customer->created_at }}</div>
                <div>Updated at: {{ $customer->updated_at }}</div>
                <a href="/customers/{{ $customer->id }}" class="text-blue-500 mt-2 inline-block">Details</a>

            </div>
        @endforeach
    </div>
@endsection
