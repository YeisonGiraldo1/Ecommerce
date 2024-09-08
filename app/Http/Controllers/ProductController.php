<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $products = Product::all();
      return view('products.index',compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        $categories = Category::all();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'brand' => 'required|string|max:255',
        'status' => 'required|in:activo,inactivo',
        'color' => 'nullable|string|max:50',
        'discount' => 'nullable|numeric|min:0|max:100',
        'stock' => 'required|integer|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id',
    ],[
        'name.required' => 'El campo nombre es obligatorio.',
        'description.required' => 'El campo descripción es obligatorio.',
        'price.required' => 'El campo precio es obligatorio.',
        'brand.required' => 'El campo marca es obligatorio.',
        'status.required' => 'El campo estado es obligatorio.',
        'color.max' => 'El campo color no debe tener más de :max caracteres.',
        'discount.numeric' => 'El campo descuento debe ser un número.',
        'discount.min' => 'El campo descuento debe ser como mínimo :min.',
        'discount.max' => 'El campo descuento no debe ser mayor que :max.',
        'stock.required' => 'El campo stock es obligatorio.',
        'stock.integer' => 'El campo stock debe ser un número entero.',
        'category_id.required' => 'El campo categoría es obligatorio.',
        'category_id.exists' => 'La categoría seleccionada no es válida.',
        'image.required' => 'El campo imagen es obligatorio.',
        'image.image' => 'El archivo seleccionado debe ser una imagen.',
        'image.mimes' => 'El archivo seleccionado debe ser de tipo: jpeg, png, jpg o gif.',
        'image.max' => 'El tamaño máximo de la imagen es :max kilobytes.',
    ]);








        $fileName = $request->file('image')->getClientOriginalName(); // Obtener el nombre original del archivo
        $request->file('image')->move(public_path('images_products'), $fileName);
    
        // Crear un nuevo producto con los datos del formulario
          $product = new Product($validatedData);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->brand = $request->input('brand');
        $product->status = $request->input('status');
        $product->color = $request->input('color');
        $product->discount = $request->input('discount');
        $product->stock = $request->input('stock');
        $product->image = $fileName; // Guardar la ruta de la imagen
        $product->category_id = $request->input('category_id');

        // Guardar el producto en la base de datos
        $product->save();
    
        // Redirigir a una vista o página de éxito
        return redirect()->route('products.index')->with('success', 'Categoría creada exitosamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id); // Obtener el producto directamente
        return view('products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


              // Validar los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'brand' => 'required|string|max:255',
        'status' => 'required|in:activo,inactivo',
        'color' => 'nullable|string|max:50',
        'discount' => 'nullable|numeric|min:0|max:100',
        'stock' => 'required|integer|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id',
    ],[
        'name.required' => 'El campo nombre es obligatorio.',
        'description.required' => 'El campo descripción es obligatorio.',
        'price.required' => 'El campo precio es obligatorio.',
        'brand.required' => 'El campo marca es obligatorio.',
        'status.required' => 'El campo estado es obligatorio.',
        'color.max' => 'El campo color no debe tener más de :max caracteres.',
        'discount.numeric' => 'El campo descuento debe ser un número.',
        'discount.min' => 'El campo descuento debe ser como mínimo :min.',
        'discount.max' => 'El campo descuento no debe ser mayor que :max.',
        'stock.required' => 'El campo stock es obligatorio.',
        'stock.integer' => 'El campo stock debe ser un número entero.',
        'category_id.required' => 'El campo categoría es obligatorio.',
        'category_id.exists' => 'La categoría seleccionada no es válida.',
        'image.required' => 'El campo imagen es obligatorio.',
        'image.image' => 'El archivo seleccionado debe ser una imagen.',
        'image.mimes' => 'El archivo seleccionado debe ser de tipo: jpeg, png, jpg o gif.',
        'image.max' => 'El tamaño máximo de la imagen es :max kilobytes.',
    ]);







        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->brand = $request->input('brand');
        $product->status = $request->input('status');
        $product->color = $request->input('color');
        $product->discount = $request->input('discount');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');
    
        if ($request->hasFile('image')) {
            // Si se selecciona una nueva imagen, almacenarla y actualizar la ruta
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images_products'), $fileName);
            $product->image = $fileName;
        }
    
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
         // Eliminar la imagen asociada al producto desde el almacenamiento
         $imagePath = public_path('images_products/' . $product->image);

         // Verificar si la imagen existe antes de intentar eliminarla
         if (File::exists($imagePath)) {
             // Eliminar la imagen
             File::delete($imagePath);
         }
     
        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }


    

    public function detail(string $id)
    {
        $productdetail = Product::with('category')->findOrFail($id); // Obtener el producto directamente
        return view('products.detail',compact('productdetail'));
    }

}
