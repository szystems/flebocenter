<!-- Row start -->
<div class="row gx-3">
    <div class="col-xl-12">
        <div class="card card-background-mask-info">
            {{-- <div class="card-header">
                <div class="card-title"><u>Doctores</u></div>
            </div> --}}
            <div class="card-body">
                <form action="{{ url('pacientes') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input class="form-control" list="exampleDataList" id="exampleDataList" placeholder="Buscar Paciente ..." name="fpaciente" value="{{ $queryPaciente }}"/>
                        <datalist id="exampleDataList">
                            @if ($queryPaciente != null)
                                <option selected value="{{ $queryPaciente }}" >{{ $queryPaciente }}</option>
                            @endif
                            @foreach ($filterPacientes as $item)
                                <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                            @endforeach
                        </datalist>
                        <button class="btn btn-outline-secondary" type="button">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->
