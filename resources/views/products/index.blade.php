@extends('adminlte::page')

@section('content')



<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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
      

        <div class="d-flex">
        <a href="/products/{{$p->id}}/edit"><div class="btn btn-warning btn-sm mr-2"><i class="fas fa-fw fa-edit"></i></div></a>

        <form  id="delete-form-{{$p->id}}" action="{{ route('products.destroy', $p->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" onclick="confirmDelete({{$p->id}})" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></button>
      </form>
    </div>
     
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

<script>
  function confirmDelete(productId) {
      Swal.fire({
          title: "¿Estás seguro?",
          text: "¡No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, eliminarlo"
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('delete-form-' + productId).submit();
          }
      });
  }
</script>