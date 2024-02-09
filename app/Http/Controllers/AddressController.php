<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;  // Importa la clase Http
class AddressController extends Controller
{
    public $token;
    public $billing_state;
    public $billing_town_city;
    public $countries;
    public $states;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses;   
        return view('addresses.index', ['data' => $addresses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "api-token" => " any5fYCO0Tqkji_TqVmICMQk3yvfNA4M-UreNjjXOg_lBSgjp6lMOUIYh52E4DVYYMI",
            "user-email"=> "daside6220@bitofee.com"
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');
           
        $this->token =$response->json('auth_token');


        
        $countries = Http::withHeaders([
            "Authorization" => "Bearer ". $this->token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/countries/');
        $this->countries = $countries->json();

        $this->states = [];
      

  

       
// dd($cities->json());


$states = Http::withHeaders([
    "Authorization" => "Bearer " . $this->token,
    "Accept" => "application/json"
])->get('https://www.universal-tutorial.com/api/states/Colombia' . $this->billing_state);


// $cities = Http::withHeaders([
//     "Authorization" => "Bearer ". $this->token,
//     "Accept" => "application/json"
// ])->get('https://www.universal-tutorial.com/api/cities/' .$this->billing_town_city);


$this->states = $states->json();

        return view('addresses.create', ['countries' => $this->countries, 'states' => $this->states]);
     
    }


 
    public function getStates()
    {
    
    }
    
    public function getCities(){

    
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
        return redirect()->route('addresses.index')
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

        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "api-token" => " any5fYCO0Tqkji_TqVmICMQk3yvfNA4M-UreNjjXOg_lBSgjp6lMOUIYh52E4DVYYMI",
            "user-email"=> "daside6220@bitofee.com"
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');
           
        $this->token =$response->json('auth_token');


        $countries = Http::withHeaders([
            "Authorization" => "Bearer ". $this->token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/countries/');
        $this->countries = $countries->json();

        $this->states = [];
      

        $states = Http::withHeaders([
            "Authorization" => "Bearer " . $this->token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/states/Colombia' . $this->billing_state);

        $this->states = $states->json();

        $address = Address::findOrfail($id);
        return view('addresses.edit',['countries' => $this->countries, 'states' => $this->states, 'address' =>$address]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Asegúra de que el usuario esté autenticado
        $user = Auth::user();
    
        // Encuentra la dirección por su ID
        $address = Address::findOrFail($id);
    
        // Verifica si el usuario tiene permiso para editar esta dirección
        if ($address->user_id !== $user->id) {
            return redirect()->route('addresses.index')
                ->with('error', 'You do not have permission to update this address.');
        }
    
        // Combina los números y asigna al campo 'number' en el request
        $combinedNumber = '#' . $request->input('number1') . '-' . $request->input('number2');
        $request->merge(['number' => $combinedNumber]);
    
        // Actualiza la dirección con los datos del formulario
        $address->update($request->all());
    
        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Address::where('id',$id)->delete();
        return redirect()->route('addresses.index');
    }
}
