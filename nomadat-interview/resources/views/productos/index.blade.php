@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="contents">

    <div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-4">Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-sm btn-primary mx-3">Agregar Producto</a>
    </div>

    <div class="container">
       <table class="table">
           <thead>
               <tr>
                   <th scope="col">ID</th>
                   <th scope="col">Nombre</th>
                   <th scope="col">Descripción</th>
                   <th scope="col">Precio</th>
                   <th scope="col">Stock</th>
                    <th scope="col">Acciones</th>
               </tr>
           </thead>
           <tbody>
            @if ($productos->isEmpty())
                <tr>
                    <div class="alert alert-info d-flex align-items-baseline" role="alert">
                        <strong>No hay productos disponibles.</strong>
                        <a href="{{ route('productos.create') }}" class="btn btn-sm btn-primary mx-3">Agregar Producto</a>
                    </div>
                </tr>
            @else
               @foreach ($productos as $producto)
                   <tr>
                       <td>{{ $producto->id }}</td>
                       <td>{{ $producto->nombre }}</td>
                       <td>{{ $producto->descripcion }}</td>
                       <td>{{ $producto->precio }}</td>
                       <td>{{ $producto->stock }}</td>
                       <td>
                           <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-primary">Editar</a>
                           <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                           </form>
                       </td>
                   </tr>
               @endforeach
            @endif
           </tbody>
       </table>
    </div>
</div>
@endsection
