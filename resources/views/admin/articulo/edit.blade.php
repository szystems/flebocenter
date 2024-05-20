@extends('layouts.admin')
@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-boxes"></i>
                </div>
                <div class="page-title">
                    <h5>Artículos</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end d-none d-sm-block">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">


            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-tabs-container">
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Editar Información</a>
                                    </li>
                                </ul>
                                <div class="tab-content h-350">
                                    <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-sm-12 col-12">
                                                @if (count($errors)>0)
                                                    <div class="alert alert-danger text-white" role="alert">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{$error}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                @endif
                                                <form action="{{ url('update-articulo/'.$articulo->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row gx-3">

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <input type="hidden" name="stock"  value="{{$articulo->stock}}">
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Nombre</label>
                                                                <input name="nombre" type="text" class="form-control" placeholder="Nombre del articulo..." value="{{ $articulo->nombre }}" />
                                                                @if ($errors->has('nombre'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('nombre') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="codigo" class="form-label">Código</label>
                                                                <input name="codigo" type="text" class="form-control" placeholder="Código del articulo..." value="{{ $articulo->codigo }}" />
                                                                @if ($errors->has('codigo'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('codigo') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <div class="mb-3">
                                                                <label for="categoria" class="form-label">Categoría</label>
                                                                <select name="categoria_id" class="form-select" aria-label="Default select example">
                                                                    @foreach($categorias as $categoria)
                                                                        <option value="{{ $categoria->id }}"{{ old('categoria_id') == $categoria->id ? ' selected' : '' }}>{{ $categoria->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('categoria_id'))
                                                                    <span class="help-block opacity-7">
                                                                        <strong>
                                                                            <font color="red">{{ $errors->first('categoria_id') }}</font>
                                                                        </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <div class="mb-3">
                                                                <label for="proveedor" class="form-label">Proveedor</label>
                                                                <select name="proveedor_id" class="form-select" aria-label="Default select example">
                                                                    @foreach($proveedores as $proveedor)
                                                                        <option value="{{ $proveedor->id }}"{{ old('proveedor_id') == $proveedor->id ? ' selected' : '' }}>{{ $proveedor->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('proveedor_id'))
                                                                    <span class="help-block opacity-7">
                                                                        <strong>
                                                                            <font color="red">{{ $errors->first('proveedor_id') }}</font>
                                                                        </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Descripción</label>
                                                                <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción del articulo...">{{ $articulo->descripcion }}</textarea>
                                                                @if ($errors->has('descripcion'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('descripcion') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <div class="mb-3">
                                                                @if ($articulo->imagen)
                                                                <label class="form-label">Imágen</label>
                                                                    <div class="brand">
                                                                        <img src="{{ asset('assets/imgs/articulos/'.$articulo->imagen) }}" class="img-thumbnail" style="height: 100px;" alt="Artíiulo" />
                                                                    </div>
                                                                @endif
                                                                <label class="form-label">Cambiar Imágen</label>
                                                                <input type="file" name="imagen" class="form-control border">
                                                                @if ($errors->has('imagen'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('imagen') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Precio Compra</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                <input name="precio_compra" type="number" class="form-control" id="precio_compra" placeholder="0.00"  value="{{ number_format($articulo->precio_compra,2, '.', ',') }}">
                                                            </div>
                                                            @if ($errors->has('precio_compra'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('precio_compra') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Precio Venta</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                <input name="precio_venta" type="number" class="form-control" id="precio_venta" placeholder="0.00" value="{{ number_format($articulo->precio_venta,2, '.', ',') }}">
                                                            </div>
                                                            @if ($errors->has('precio_venta'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('precio_venta') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                        </div>

                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ url('articulos') }}" type="button" class="btn btn-danger">
                                                            <i class="bi bi-x-circle"></i> Cancelar
                                                        </a>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="bi bi-check2-square"></i> Grabar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Row end -->
                                    </div>

                                </div>
                                {{-- <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ url('edit-user/'.$user->id) }}" type="button" class="btn btn-outline-secondary">
                                        Cancelar
                                    </a>
                                    <button type="button" class="btn btn-success">
                                        Update
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->

@endsection
