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
                                <div class="col-12 col-md-auto float-end">
                                    <div class="btn-group-sm m-3">
                                        <a href="{{ url('edit-articulo/'.$articulo->id) }}" class="btn btn-warning" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $articulo->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                        @include('admin.articulo.deletemodal')
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Información</a>
                                    </li>
                                </ul>
                                <div class="tab-content h-350">
                                    <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-sm-12 col-12">
                                                <div class="row gx-3">

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="nombre" class="form-label">Nombre</label>
                                                            <p>{{ $articulo->nombre }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="codigo" class="form-label">Código</label>
                                                            <p>{{ $articulo->codigo }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="categoria" class="form-label">Categoría</label>
                                                            <p>{{ $articulo->categoria->nombre }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="proveedor" class="form-label">Proveedor</label>
                                                            <p>{{ $articulo->proveedor->nombre }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Descripción</label>
                                                            @if ($articulo->descripcion != null)
                                                                <p>{{ $articulo->descripcion }}</p>
                                                            @else
                                                                <p>Sin descripción.</p>
                                                            @endif

                                                        </div>
                                                    </div>

                                                    @if ($articulo->imagen != null)
                                                    <div class="col-md-6 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Imágen</label>
                                                            <div class="brand">
                                                                <img src="{{ asset('assets/imgs/articulos/'.$articulo->imagen) }}" class="img-thumbnail" style="height: 100px;" alt="Articulo" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif



                                                    <hr>

                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Precio Compra</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                            <span class="input-group-text text-yellow"><strong>{{ number_format($articulo->precio_compra,2, '.', ',') }}</strong></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Precio Venta</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                            <span class="input-group-text text-success"><strong>{{ number_format($articulo->precio_venta,2, '.', ',') }}</strong></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Cantidad (Stock)</label>
                                                        <div class="input-group">
                                                            {{-- <span class="input-group-text">{{ $config->currency_simbol }}.</span> --}}
                                                            <p><strong>{{ $articulo->stock }}</strong></p>
                                                        </div>
                                                        <div id="precio_venta_error" class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Stock Minimo</label>
                                                        <div class="input-group">
                                                            <p><strong>{{ $articulo->stock_minimo }}</strong></p>
                                                        </div>
                                                        <div id="precio_venta_error" class="invalid-feedback"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row end -->
                                    </div>

                                </div>
                                {{-- <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary">
                                        Cancel
                                    </button>
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
