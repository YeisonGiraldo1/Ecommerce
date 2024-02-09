<!-- resources/views/addresses/create.blade.php -->

<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="max-w-3xl mx-auto bg-white p-8 border border-gray-300 rounded-md">
            <h2 class="text-2xl font-semibold mb-6">Actualizar Direccion</h2>



            <form action="{{route('addresses.update' , $address->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Esto es necesario para indicar que es una solicitud PUT --}}
                <form wire:submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Nombre Completo</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 w-2/3 border rounded-md" value="{{$address->name}}">
                </div>

               
                
                <div class="mb-4 flex space-x-4">
                    <div class="flex-1">
                        <label for="department" class="block text-sm font-medium text-gray-600">Departamento</label>
                        <select wire:model="billing_town_city" name="department" id="department" class="mt-1 p-2 w-full border rounded-md">
                            @foreach ($states as $state)
                                <option value="{{ $state['state_name'] }}">{{ $state['state_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="flex-1">
                        <label for="city" class="block text-sm font-medium text-gray-600">Municipio/Ciudad</label>
                    
                            <input type="text" name="city" id="city" class="mt-1 p-2 w-1/2 border rounded-md" value="{{$address->city}}">
                       
                    </div>
                </div>
                

                

               
              
                <div class="mb-4">
                    <label for="neighborhood" class="block text-sm font-medium text-gray-600">Barrio</label>
                    <input type="text" name="neighborhood" id="neighborhood" class="mt-1 p-2 w-1/2 border rounded-md" value="{{$address->neighborhood}}">
                </div>


                <div class="mb-4 flex space-x-4">
                <div class="flex-1">
                    <label for="street_type" class="block text-sm font-medium text-gray-600">Tipo de Calle</label>
                    <select name="street_type" id="street_type" class="mt-1 p-2 w-full border rounded-md">
                        <option value="Calle">Calle</option>
                        <option value="Carrera" {{ $address->street === 'Carrera' ? 'selected' : '' }}>Carrera</option>
                        <option value="Avenida">Avenida</option>
                     ¿
                    </select>
                </div>

                <div class="flex-1">
                    <label for="street" class="block text-sm font-medium text-gray-600">Calle</label>
                    <input type="text" name="street" id="street" class="mt-1 p-2 w-full border rounded-md" value="{{$address->street}}">
                </div>


                <div class="flex-1">
                    <label for="street" class="block text-sm font-medium text-gray-600">Numero</label>
                    <input type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md" value="{{$address->number}}">
                </div>
              
            </div>
                



                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium text-gray-600">Número de Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" class="mt-1 p-2 w-full border rounded-md" value="{{$address->phone_number}}">
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        Editar Dirección
                    </button>
                </div>
            </form>
         
            
</form>
        </div>
    </div>
</x-app-layout>


