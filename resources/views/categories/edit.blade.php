@extends('adminlte::page')


@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">ACTUALIZAR CATEGORIA</h1><br>
</body>
<div class="card">
  <div class="card-header">
    Actualizar categoria
  </div>
  <div class="card-body">
  @foreach($data as $c)
  <form action="{{ route('categories.update', $c->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Esto es necesario para indicar que es una solicitud PUT --}}
    <!-- Resto del formulario... -->


    <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$c->name}}">
        </div>

        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="description" name="description" value="{{$c->description}}">
        </div>
    </div>

    <br>


    <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" >
        </div>


        <div class="col-md-6">
        <label for="exampleInputEmail1" class="form-label">Estado</label>
        <select name="status" id="" class="form-control">
    <option value="activo" {{ $c->status === 'activo' ? 'selected' : '' }}>Activo</option>
    <option value="inactivo" {{ $c->status === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
</select>
        </div>
    </div>
<br>
 <div class="row">
    <div class="col-md-12">
<button type="submit" class="btn btn-outline-success btn-lg">Editar</button>
    </div>
    </div>


  

</form>
@endforeach
  </div>
</div>
</html>
@stop