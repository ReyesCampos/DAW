@extends('admin.layouts.main')

@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              <button class="btn btn-outline-primary btn_sm" data-toggle="modal" data-target="#modal-add">
                <i class="fa fa-plus"></i>  
                Agregar Producto
              </button>
              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/admin/productos" method="POST">
                @if($message = Session::get('errorInsert'))
                <div class="alert alert-danger alert-dismissable fade show col-12" role="alert">
                    <h5>Error:</h5>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control form-control-border" id="nombre" name="nombre" value="{{@old('nombre')}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control form-control-border" id="descripcion" name="descripcion" value="{{@old('descripcion')}}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control form-control-border" id="stock" min="1" name="stock" value="{{@old('stock')}}">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" class="form-control form-control-border" id="precio" min="1" name="precio" value="{{@old('precio')}}">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            @if($message = Session::get('errorInsert'))
                $("#modal-add").modal('show');
            @endif
        });
    </script>
@endsection