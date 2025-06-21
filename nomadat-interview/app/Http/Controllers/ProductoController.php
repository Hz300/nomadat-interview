<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }


    public function create()
    {
        return view('productos.create');
    }


    public function store(Request $request)
    {
        $validatedData = $this->validateData($request);

        Producto::create($validatedData);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }


    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }


    public function edit($producto_id)
    {
        $producto = Producto::findOrFail($producto_id);
        return view('productos.edit', compact('producto'));
    }


    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }


    public function update(Request $request, $producto_id)
    {
        $validatedData = $this->validateData($request);

        $producto = Producto::findOrFail($producto_id);
        $producto->update($validatedData);
        return redirect()->route('productos.index', $producto)->with('success', 'Producto actualizado correctamente.');
    }


    private function validateData(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:1',
        ]);

        return $validatedData;
    }
}
