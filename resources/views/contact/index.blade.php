@extends('adminlte::page')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">




<table class="table table-dark table-sm">
<h1 class="text-center">LISTADO MENSAJES DE USUARIO</h1><br>
  <thead >
    <tr>

    <th>Nombre</th>
    <th>Acciones</th>
  </tr>
</thead>
<tbody>
    <tr>@forelse($messages as $m)
     
      <td>{{$m->name}}</td> 
      <td>
      
        <a href="/message/detail/{{$m->id}}"><div class="btn btn-outline-primary"><i class="fas fa-eye"></i>
        </div></a>

      
          <button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-trash"></i></button>
     
  
     
      </td>
     

      
    </tr>
  </tbody>
  @empty
    <th colspan="5">No hay mensajes</th>
     
    @endforelse
  

</table>


    <style>
        *{
            font-family: 'Courier New', Courier, monospace;
        }
    </style>



@endsection