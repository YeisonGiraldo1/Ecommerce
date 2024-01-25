@extends('adminlte::page')

@section('content')






<table class="table table-dark table-sm">
<h1 class="text-center">LISTADO PRODUCTOS</h1><br>
  <thead >
    <tr>

    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Precio</th>
    <th>Marca</th>
    <th>Estado</th>
    <th>Color</th>
    <th>Descuento</th>
    <th>Stock</th>
    <th>Imagen</th>
    <th>Categoria</th>
    <th>Acciones</th>
  </tr>
</thead>
<tbody>
    <tr>@forelse($products as $p)
     
      <td>{{$p->name}}</td>
      <td>{{$p->description}}</td>
      <td>{{$p->price}}</td>
      <td>{{$p->brand}}</td>
      <td>{{$p->status}}</td>
      <td>{{$p->color}}</td>
      <td>{{$p->discount}}% </td>
      <td>{{$p->stock}}</td>
      <td><img src="{{ asset('images_products/' . $p->image) }}" width="180" height="160"></td>  
      <td>{{$p->getCategoryName()}}</td>


      
     
     
   
      <td>
      
        <a href="/products/{{$p->id}}/edit"><div class="btn btn-outline-primary">Actualizar</div></a>

        <form action="{{ route('products.destroy', $p->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-danger btn-lg">Eliminar</button>
      </form>
  
     
      </td>
     

      
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