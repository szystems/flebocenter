<!-- Row start -->
<div class="row gx-3">
    <div class="col-xl-12">
        <div class="card card-background-mask-info">
            {{-- <div class="card-header">
                <div class="card-title"><u>Doctores</u></div>
            </div> --}}
            <div class="card-body">

                <div class="accordion" id="accordionSpecialTitle">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSpecialTitleOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSpecialTitleOne" aria-expanded="true"
                                aria-controls="collapseSpecialTitleOne">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-filter text-info"></i>
                                    <div class="ms-3">
                                        <h5 class="text-yellow">Filtros de Búsqueda</h5>
                                        {{-- <p class="m-0 fw-normal">Leader</p> --}}

                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseSpecialTitleOne" class="accordion-collapse collapse"
                            aria-labelledby="headingSpecialTitleOne" data-bs-parent="#accordionSpecialTitle">
                            <div class="accordion-body">
                                <form action="{{ url('inventario') }}" method="GET">
                                    @csrf
                                    <div class="row gx-3">

                                        <div class="col-md-3 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="articulo" class="form-label">Articulo</label>
                                                <input class="form-control" placeholder="Nombre o codígo del articulo..." name="nombre" value="{{ old('nombre', request('nombre')) }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="categoria" class="form-label">Categoría</label>
                                                <select name="categoria_id" class="form-select" aria-label="Default select example">
                                                    <option value="">Todas</option>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"{{ old('categoria_id', request('categoria_id')) == $categoria->id ? ' selected' : '' }}>{{ $categoria->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="proveedor" class="form-label">Proveedor</label>
                                                <select name="proveedor_id" class="form-select" aria-label="Default select example">
                                                    <option value="">Todas</option>
                                                    @foreach($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}"{{ old('proveedor_id', request('proveedor_id')) == $proveedor->id ? ' selected' : '' }}>{{ $proveedor->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Stock</label>
                                                <select name="stock" class="form-select" aria-label="Default select example">
                                                    <option value=""{{ request('stock') == '' ? ' selected' : '' }}>Todos</option>
                                                    <option value="Con Stock"{{ request('stock') == 'Con Stock' ? ' selected' : '' }}>Con Stock</option>
                                                    <option value="Sin Stock"{{ request('stock') == 'Sin Stock' ? ' selected' : '' }}>Sin Stock</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="stock_minimo" class="form-label">Stock Minimo</label>
                                                <select name="stock_minimo" class="form-select" aria-label="Default select example">
                                                    <option value=""{{ request('stock_minimo') == '' ? ' selected' : '' }}>Todos</option>
                                                    <option value="<="{{ request('stock_minimo') == '<=' ? ' selected' : '' }}><=</option>
                                                    <option value=">"{{ request('stock_minimo') == '>' ? ' selected' : '' }}>></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3 mt-4">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Row end -->
