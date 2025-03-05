<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.customers.index', ['customers' => Customer::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:customers'],
            'phone' => ['required', 'string'],
            'license_number' => ['required', 'string'],
        ]);

        // DB::table('customers')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'license_number' => $request->license_number,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->license_number = $request->license_number;

        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Il cliente è stato aggiunto con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = DB::table('customers')->find($id);
        return view('layouts.customers.show', ['customer' => $customer]);
    }
}
