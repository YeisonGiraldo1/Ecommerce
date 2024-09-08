@extends('adminlte::page')

@section('content')






<table class="table table-dark table-sm">
<h1 class="text-center">LISTADO PRODUCTOS</h1><br>
  <thead >
    <tr>
    <th>Id</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Rol</th>
  </tr>
</thead>
<tbody>
    <tr>@forelse($users as $u)
     
      <td>{{$u->id}}</td>
      <td>{{$u->name}}</td>
      <td>{{$u->email}}</td>
      <td>{{$u->role}}</td>
    
     

      
    </tr>
  </tbody>
  @empty
    <th colspan="5">No hay usuarios</th>
     
    @endforelse
  

</table>


    <style>
        *{
            font-family: 'Courier New', Courier, monospace;
        }
    </style>



@endsection