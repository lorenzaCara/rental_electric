@extends('layouts.app')

@section('title', 'Customer')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Customers</h1>
    <div class="space-y-4">
        <div class="p-4 border rounded-lg">
            <div class="font-semibold">Name: <span class="text-blue-500">{{ $customer->name }}</span></div>
            <div>Email: {{ $customer->email }}</div>
            <div>Phone: {{ $customer->phone }}</div>
            <div>Created at: {{ $customer->created_at }}</div>
            <div>Updated at: {{ $customer->updated_at }}</div>

        </div>

    </div>
@endsection
