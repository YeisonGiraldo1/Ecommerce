<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = $request->file('image')->getClientOriginalName(); // Obtener el nombre original del archivo
        $request->file('image')->move(public_path('images_categories'), $fileName);
    
        // Crear una nueva categoria con los datos del formulario
        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->image = $fileName; // Guardar la ruta de la imagen
        $category->status = $request->input('status');
    
        // Guardar la categoria en la base de datos
        $category->save();
    
        // Redirigir a una vista o página de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
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
        $data['data'] = Category::where('id', $id)->get();
        return view('categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
  
     public function update(Request $request, string $id)
{
    $category = Category::find($id);

    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->status = $request->input('status');

    if ($request->hasFile('image')) {
        // Si se selecciona una nueva imagen, almacenarla y actualizar la ruta
        $fileName = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images_categories'), $fileName);
        $category->image = $fileName;
    }

    $category->save();

    return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

           // Eliminar la imagen asociada al la categoria desde el almacenamiento
           $imagePath = public_path('images_categories/' . $category->image);

           // Verificar si la imagen existe antes de intentar eliminarla
           if (File::exists($imagePath)) {
               // Eliminar la imagen
               File::delete($imagePath);
           }
        return redirect()->route('categories.index')
        ->with('success', 'Post deleted successfully');
    }




    //MOSTRAR PRODUCTOS DE LA CATEGORIA SELECCIONADA

    public function showproducts(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        $productsquantity = Product::where('category_id', $category->id)->count();
        return view('categories.showproducts', compact('products', 'category','productsquantity'));

    }


    }

