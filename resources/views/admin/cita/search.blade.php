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
                                <form action="{{ url('citas') }}" method="GET">
                                    @csrf
                                    <div class="row gx-3">

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-2">
                                                <label for="ffecha" class="form-label">Fecha</label>
                                                <div class="input-group">
                                                    <input type="text" name="ffecha" class="form-control datepicker" id="ffecha" value="{{ $fechaVista }}"/>
                                                    <span class="input-group-text">
                                                        <i class="bi bi-calendar4"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="fclinica" class="form-label">Clinica</label>
                                                <select name="fclinica" class="form-select" aria-label="Default select example">
                                                    <option value="">Todas</option>
                                                    @foreach($filtroClinicas as $clinica)
                                                        <option value="{{ $clinica->id }}"{{ old('fclinica', request('fclinica')) == $clinica->id ? ' selected' : '' }}>{{ $clinica->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="fdoctor" class="form-label">Doctor</label>
                                                <select name="fdoctor" class="form-select" aria-label="Default select example">
                                                    <option value="">Todas</option>
                                                    @foreach($filtroDoctores as $doctor)
                                                        <option value="{{ $doctor->id }}"{{ old('fdoctor', request('fdoctor')) == $doctor->id ? ' selected' : '' }}>{{ $doctor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="fpaciente" class="form-label">Paciente</label>
                                                <input class="form-control" placeholder="(DPI o Nombre)..." name="fpaciente" value="{{ old('fpaciente', request('fpaciente')) }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="festado" class="form-label">Estado</label>
                                                <select name="festado" class="form-select" aria-label="Default select example">
                                                    <option value=""{{ request('festado') == '' ? ' selected' : '' }}>Todos</option>
                                                    <option value="Pendiente"{{ request('festado') == 'Pendiente' ? ' selected' : '' }}>Pendiente</option>
                                                    <option value="Confirmada"{{ request('festado') == 'Confirmada' ? ' selected' : '' }}>Confirmada</option>
                                                    <option value="Atendida"{{ request('festado') == 'Atendida' ? ' selected' : '' }}>Atendida</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
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

<script>
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    var optSimple = {
        language: "es",
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        todayBtn: "linked",
        orientation: "bottom auto",
        startDate: "01-01-1900",

    };
    $( '#ffecha' ).datepicker( optSimple );
</script>
<!-- Row end -->
