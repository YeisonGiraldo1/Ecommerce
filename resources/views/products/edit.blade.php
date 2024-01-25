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
    <h1 class="text-center">ACTUALIZAR PRODUCTO</h1><br>
</body>
<div class="card">
  <div class="card-header">
    Actualizar producto
  </div>
  <div class="card-body">

  <form action="{{route('products.update' , $product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Esto es necesario para indicar que es una solicitud PUT --}}

    <div class="row">
        <div class="col-md-12">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
        </div>
        </div>

        <div class="col-md-3">
    <label for="exampleInputEmail1" class="form-label">Descripción</label>
    <textarea name="description" class="form-control" id="" cols="30" rows="4" style="width: 1200px;">{!! old('description', $product->description) !!}</textarea>
</div>


        <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">
        </div>

        <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Marca</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{$product->brand}}">
        </div>
        </div>

    <br>

    <div class="row">


        <div class="col-md-3">
        <label for="exampleInputEmail1" class="form-label">Estado</label>
        <select name="status" id="" class="form-control">
            <option value="">Selecciona una opcion</option>
            <option value="activo" {{ $product->status === 'activo' ? 'selected' : '' }}>Activo</option>
    <option value="inactivo" {{ $product->status === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        </div>


        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="{{$product->color}}">
        </div>


        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Descuento%</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{$product->discount}}">
        </div>


        <div class="col-md-3">
            <label for="exampleInputEmail1" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{$product->stock}}">
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
<button type="submit" class="btn btn-outline-success btn-lg">Actualizar</button>
    </div>
    </div>


  

</form>
  </div>
</div>
</html>
@stop