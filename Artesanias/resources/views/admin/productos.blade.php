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

    <div class="content">
      <div class="container-fluid">
        <div class="row">
        @if($message = Session::get('Listo'))
                <div class="alert alert-success alert-dismissable fade show col-12" role="alert">
                    <h5>Listo</h5>
                    <p>{{$message}}</p>
                </div>
        @endif

        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Tags</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          @foreach($productos as $p)
            <tr>
              
              <td>
              <img src="{{asset('img/productos/'.$p->img)}}" alt="" width="70px">
              {{$p->name}}
              </td>
              <td>{{$p->description}}</td>
              <td>{{$p->price}}</td>
              <td>{{$p->stock}}</td>
              <td>{{$p->tags}}</td>
              <td>
                <button class="btn btn-danger btnEliminar" data-id="{{$p->id}}" 
                data-toggle="modal" data-target="#modal-delete">
                <i class="fa fa-trash"></i>
                </button>
                <button class="btn btn-primary btnEdit" 
                data-id="{{$p->id}}" data-name="{{$p->name}}" data-description="{{$p->description}}" 
                data-price="{{$p->price}}" data-stock="{{$p->stock}}" data-tags="{{$p->tags}}"
                data-toggle="modal" data-target="#modal-edit">
                <i class="fa fa-edit"></i>
                </button>
                <form action="{{url('/admin/productos', ['id'=>$p->id])}}" method="POST" id="formEliminar_{{$p->id}}">
                @csrf
                <input type="hidden" name="id" value="{{$p->id}}">
                <input type="hidden" name="_method" value="delete">
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>

        </div>
      </div>
    </div>

<!-- Modal ADD -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/admin/productos" method="POST" enctype="multipart/form-data">
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
                        <input type="number" class="form-control form-control-border" id="stock" min="1" name="stock" value="{{@old('stock')}}">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" class="form-control form-control-border" id="precio" min="1" name="precio" value="{{@old('precio')}}">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control form-control-border" id="imagen" min="1" name="imagen" value="{{@old('imagen')}}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control form-control-border" id="tags" min="1" name="tags" value="{{@old('tags')}}">
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

<!-- Modal Delete -->
    <div class="modal fade" id="modal-delete">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Eliminar Producto</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                    <div class="modal-body">
                        <h2 class="h6">¿Desea eliminar el producto?</h2>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger btnCloseEliminar">Eliminar</button>
                    </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->


<!-- Modal Edit -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/admin/productos/edit" method="POST" enctype="multipart/form-data">
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
                  <input type="hidden" id="idEdit" name="id">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control form-control-border" id="nameEdit" name="nombre" value="{{@old('nombre')}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control form-control-border" id="descriptionEdit" name="descripcion" value="{{@old('descripcion')}}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control form-control-border" id="stockEdit" min="1" name="stock" value="{{@old('stock')}}">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" class="form-control form-control-border" id="priceEdit" min="1" name="precio" value="{{@old('precio')}}">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control form-control-border" id="imagen" min="1" name="imagen" value="{{@old('imagen')}}">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control form-control-border" id="tagsEdit" min="1" name="tags" value="{{@old('tags')}}">
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
    var idEliminar=-1;
        $(document).ready(function(){
            @if($message = Session::get('errorInsert'))
                $("#modal-add").modal('show');
            @endif
            @if($message = Session::get('errorEdit'))
                $("#modal-edit").modal('show');
            @endif
            $(".btnEliminar").click(function(){
              var id=$(this).data('id');
              idEliminar=id;
            });
            $(".btnEdit").click(function(){
              var id=$(this).data('id');
              var name=$(this).data('name');
              var description=$(this).data('description');
              var stock=$(this).data('stock');
              var price=$(this).data('price');
              var tags=$(this).data('tags');
              $("#idEdit").val(id);
              $("#nameEdit").val(name);
              $("#descriptionEdit").val(description);
              $("#stockEdit").val(stock);
              $("#priceEdit").val(price);
              $("#tagsEdit").val(tags);
            });
            $(".btnCloseEliminar").click(function(){
              $("#formEliminar_"+idEliminar).submit();
            });
        });
    </script>
@endsection