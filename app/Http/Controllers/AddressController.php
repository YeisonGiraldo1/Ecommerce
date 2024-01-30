<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Address::all();        
        return view('addresses.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Asegúra de que el usuario esté autenticado
        $user = Auth::user();

         // Asigna el user_id al request antes de crear la dirección
         $combinedNumber = '#' . $request->input('number1') . '-' . $request->input('number2');
         $request->merge(['number' => $combinedNumber, 'user_id' => $user->id]);

        Address::create($request->all());
        return redirect()->route('welcome')
          ->with('success', 'Address created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
