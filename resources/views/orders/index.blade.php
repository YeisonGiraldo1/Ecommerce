@extends('adminlte::page')

@section('content')






<table class="table table-dark table-sm">
<h1 class="text-center">PEDIDOS</h1><br>
  <thead >
    <tr>

    <th>Usuario</th>
    <th>Direccion</th>
    <th>Total</th>
    <th>Estado</th>
    <th>Detalle</th>
    <th>Acciones</th>
  </tr>
</thead>
<tbody>
    <tr>@forelse($allorders as $order)
     
      <td>{{$order->user_id}}</td>
      <td>{{$order->address_id}}</td>
      <td>{{$order->total}}</td>
      <td>{{$order->status}}</td>
      <td>   <button class="btn btn-info btn-sm">
        Ver Detalle <i class="fas fa-info-circle"></i>
    </button></td>
      <td></td>
    
     
     

      
    </tr>
  </tbody>
  @empty
    <th colspan="5">No hay productos</th>
     
    @endforelse
  

</table>


    <style>
        *{
            font-family: 'Courier New', Courier, monospace;
        }
    </style>



@endsection