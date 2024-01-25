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
    <h1 class="text-center">CREAR CATEGORIA</h1><br>
</body>
<div class="card">
  <div class="card-header">
    Crear categoria
  </div>
  <div class="card-body">
  <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
    </div>

    <br>


    <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>


        <div class="col-md-6">
        <label for="exampleInputEmail1" class="form-label">Estado</label>
        <select name="status" id="" class="form-control">
            <option value="">Selecciona una opcion</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
        </div>
    </div>
<br>
 <div class="row">
    <div class="col-md-12">
<button type="submit" class="btn btn-outline-success btn-lg">Crear</button>
    </div>
    </div>


  

</form>
  </div>
</div>
</html>
@stop