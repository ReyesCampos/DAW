@extends('admin.layouts.main')

@section('contenido')
<h2>Estoy en los productos</h2>
<form action="/admin/productos" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Aceptar</button>
</form>
@endsection
@section('scripts')
<script>console.log("asdasdasd");</script>
@endsection