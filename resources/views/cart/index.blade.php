<x-app-layout>
<!-- component -->
<!-- Create By Joker Banny -->
<style>
  @layer utilities {
  input[type="number"]::-webkit-inner-spin-button,
  input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
}
</style>

<body>
<div class="h-screen bg-gray-100 pt-20">
  <h1 class="mb-10 text-center text-2xl font-bold">Carrito de comprass</h1>
  <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
    <div class="rounded-lg md:w-2/3">
      @if($items->isEmpty())
      <div class="text-center">
        <h1 class="mb-4 text-4xl font-bold text-gray-700">¡Tu carrito está vacío!</h1>
        <p class="text-lg text-gray-500 mb-8">Descubre nuestros increíbles productos y encuentra algo que te encante.</p>
        <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600 transition duration-300 ease-in-out">Explorar Productos</a>
    </div>
    
      @else @foreach($items as $p)
      <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
        <img  src="{{ asset('images_products/' . $p->image) }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
          <div class="mt-5 sm:mt-0">
            <h2 class="text-lg font-bold text-gray-900">{{$p->name}}</h2>
            <p class="mt-1 text-xs text-gray-700">{{$p->price}}</p>
          </div>
          <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
            <div class="flex items-center border-gray-100">
              <a href="{{ route('cart.update', ['id' => $p->id, 'quantity' => $p->quantity - 1]) }}" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"> - </a>
              <input class="h-8 w-8 border bg-white text-center text-xs outline-none" type="number" value="{{ $p->quantity }}" min="0" />
              <a href="{{ route('cart.update', ['id' => $p->id, 'quantity' => $p->quantity + 1]) }}" class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"> + </a>
          </div>
            <div class="flex items-center space-x-4">
              <p class="text-sm">${{$p->price*$p->quantity}}</p>
              <a href="{{ route ('cart.delete' ,['id' => $p->id])}}" class="text-red-500 hover:text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            
            </div>
          </div>
        </div>
      </div>
      @endforeach @endif

      
      
    </div>
    <!-- Sub total -->

    @if(!$items->isEmpty())
    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
      <div class="mb-2 flex justify-between">
        <p class="text-gray-700">Subtotal</p>
        <p class="text-gray-700">${{$total}}</p>
      </div>
      <div class="flex justify-between">
        <p class="text-gray-700">Envio</p>
        <p class="text-gray-700">$0</p>
      </div>
      <hr class="my-4" />
      <div class="flex justify-between">
        <p class="text-lg font-bold">Total</p>
        <div class="">
          <p class="mb-1 text-lg font-bold">${{$total}}</p>
          <p class="text-sm text-gray-700"></p>
        </div>
      </div>
      
      <a href="{{route ('checkout') }}"><button  class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check out</button></a>
      @endif
    </div>
  </div>
</div>
</body>
</x-app-layout>