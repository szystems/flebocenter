@extends('layouts.admin')

@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-inboxes"></i>
                </div>
                <div class="page-title">
                    <h5>Inventario</h5>
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

            @include('admin.inventario.search')

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                Listado de Inventario
                                <a href="{{ url('add-articulo') }}" type="button" class="btn btn-success float-end">
                                    <i class="bi bi-plus-square"></i> Agregar
                                </a>
                                <br>
                                <small class="text-secondary"><u>Filtros:</u></small>
                                <small class="text-muted">

                                    Encontrados: <small class="text-info">{{ $articulos->count() }},</small>

                                    @if (request('nombre'))

                                        Articulo:  <small class="text-info">{{ request('nombre') }},</small>
                                    @endif
                                    @if (request('categoria_id'))
                                        @php
                                            $categoria = \App\Models\Categoria::find( request('categoria_id') );
                                        @endphp
                                        Categoría:  <small class="text-info">{{ $categoria->nombre }},</small>
                                    @endif
                                    @if (request('proveedor_id'))
                                        @php
                                            $proveedor = \App\Models\Proveedor::find( request('proveedor_id') );
                                        @endphp
                                        Proveedor:  <small class="text-info">{{ $proveedor->nombre }},</small>
                                    @endif
                                    @if (request('stock'))
                                        Stock:  <small class="text-info">{{ request('stock') }},</small>
                                    @endif
                                    @if (request('stock_minimo'))
                                        Stock Minimo:  <small class="text-info">{{ request('stock_minimo') }},</small>
                                    @endif
                                </small>
                                <br>
                                <button type="button" class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#printInventarioModal">
                                    <i class="bi bi-printer"></i> Imprimir
                                </button>

                                @include('admin.inventario.printinventariomodal')
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-striped flex-column">
                                    <thead>
                                        <tr>
                                            {{-- <td align="center"><i class="bi bi-list-task"></i></td> --}}
                                            <td>Artículo</td>
                                            <td align="center">Precio</td>
                                            <td>Stock</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articulos as $articulo)
                                        <tr>
                                            {{-- <td align="center">
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                        <i class="bi bi-list-task"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('show-articulo/'.$articulo->id) }}"><i class="bi bi-eye-fill text-blue"></i> Información</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('edit-articulo/'.$articulo->id) }}"><i class="bi bi-pencil-fill text-warning"></i> Editar</a>
                                                        </li>
                                                        <li>
                                                            <a type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $articulo->id }}">
                                                                <i class="bi bi-trash-fill text-danger"></i> Eliminar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($articulo->imagen != null)
                                                    <a class="text-primary" href="{{ url('show-articulo/'.$articulo->id) }}"><img src="{{ asset('assets/imgs/articulos/'.$articulo->imagen) }}" class="img-4x rounded-2 me-3" alt="Inventaro" /></a>
                                                    @else
                                                    <a class="text-primary" href="{{ url('show-articulo/'.$articulo->id) }}"><img src="{{ asset('assets/imgs/articulos/default.png') }}" class="img-4x rounded-2 me-3" alt="Inventario" /></a>
                                                    @endif

                                                    <p class="m-0">
                                                        <a class="text-primary" href="{{ url('show-articulo/'.$articulo->id) }}"><font color="gray"><small>{{ $articulo->codigo }}</small></font> <b>{{ $articulo->nombre }}</b></a>
                                                        <br>
                                                        <small>
                                                            Categoría: <a class="text-secondary" href="{{ url('show-categoria/'.$articulo->categoria->id) }}"><b>{{ $articulo->categoria->nombre }}</b></a>
                                                            <br>
                                                            Proveedor: <a class="text-yellow" href="{{ url('show-articulo/'.$articulo->proveedor->id) }}"><b>{{ $articulo->proveedor->nombre }}</b></a>
                                                        </small>
                                                    </p>

                                                </div>
                                            </td>
                                            <td align="center">
                                                <p><small class=" text-info"><strong>{{ $config->currency_simbol }}.{{ number_format($articulo->precio_compra, 2, '.', ',') }}</strong></small></p>
                                                {{-- <br>
                                                Venta: <small class=" text-success"><strong>{{ $config->currency_simbol }}.{{ number_format($articulo->precio_venta, 2, '.', ',') }}</strong></small> --}}
                                            </td>
                                            <td>
                                                <p>
                                                {{-- Stock: --}}
                                                @if ($articulo->stock <= 0)
                                                    <strong class="text-danger">{{ $articulo->stock }}</strong>
                                                @endif
                                                @if (($articulo->stock > 0) and ($articulo->stock <= $articulo->stock_minimo))
                                                    <strong class="text-warning">{{ $articulo->stock }}</strong>
                                                @endif
                                                @if ($articulo->stock > $articulo->stock_minimo)
                                                    <strong class="text-success">{{ $articulo->stock }}</strong>
                                                @endif
{{--
                                                 <br>
                                                 Min: <strong>{{ $articulo->stock_minimo }}</strong> --}}
                                                </p>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

