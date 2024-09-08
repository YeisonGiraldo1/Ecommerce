@extends('adminlte::page')

@section('content')






<table class="table table-dark table-sm">
<h1 class="text-center">LISTADO CATEGORIAS</h1><br>
  <thead >
    <tr>

    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Estado</th>
    <th>Imagen</th>
    <th>Acciones</th>
  </tr>
</thead>
<tbody>
    <tr>@forelse($categories as $c)
     
      <td>{{$c->name}}</td>
      <td>{{$c->description}}</td>
      <td>{{$c->status}}</td>
      <td><img src="{{ asset('images_categories/' . $c->image) }}" width="180" height="160"></td>  


      
     
     
   
      <td>
        <div class="d-flex ; d-20">
        <a href="/categories/{{$c->id}}/edit"><div class="btn btn-warning btn-sm mr-2"><i class="fas fa-fw fa-edit"></i></div></a>

        <form action="{{ route('categories.destroy', $c->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></button>
      </form>
    </div>
      </td>
     

      
    </tr>
  </tbody>
  @empty
    <th colspan="5">No hay categorias</th>
     
    @endforelse
  

</table>


    <style>
        *{
            font-family: 'Courier New', Courier, monospace;
        }
    </style>



@endsection