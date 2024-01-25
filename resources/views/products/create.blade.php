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
    <h1 class="text-center">CREAR PRODUCTO</h1><br>
</body>
<div class="card">
  <div class="card-header">
    Crear producto
  </div>
  <div class="card-body">
  <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="row">
        <div class="col-md-12">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        </div>

        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" id="" cols="30" rows="4" style="width: 1200px;" placeholder="Detalla el producto..."></textarea>
        </div>

        <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>

        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Marca</label>
            <input type="text" class="form-control" id="brand" name="brand">
        </div>
        </div>

    <br>


    <div class="row">


        <div class="col-md-3">
        <label for="exampleInputEmail1" class="form-label">Estado</label>
        <select name="status" id="" class="form-control">
            <option value="">Selecciona una opcion</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
        </div>


        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color">
        </div>


        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Descuento%</label>
            <input type="number" class="form-control" id="discount" name="discount">
        </div>


        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock">
        </div>
    </div>


    <div class="row">
    <div class="col-md-6">
        <label for="exampleInputEmail1" class="form-label">Imagen</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Categoria</label>
            <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
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