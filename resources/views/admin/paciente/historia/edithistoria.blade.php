@extends('layouts.admin')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-person"></i>
                </div>
                <div class="page-title">
                    <h5>Pacientes</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end  d-none d-sm-block">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="subscribe-header">
                <img src="{{ asset('dashboardtemplate/design/assets/images/bg.jpg') }}" class="img-fluid w-100" alt="Header" />
            </div>
            <div class="subscriber-body">
                <!-- Row start -->
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-12">
                        <!-- Row start -->
                        <div class="row align-items-end">
                            <a href="{{ url('show-paciente/'.$paciente->id) }}">
                                <div class="col-auto">
                                    @if ($paciente->fotografia != null)
                                        <img src="{{ asset('assets/imgs/pacientes/'.$paciente->fotografia) }}" class="img-7xx rounded-circle" />
                                    @else
                                        <img src="{{ asset('assets/imgs/pacientes/doctoricon.png') }}" class="img-7xx rounded-circle" />
                                    @endif
                                </div>
                                <div class="col">
                                    <h6>Paciente</h6>
                                    <h4 class="m-0">{{ $paciente->nombre }}</h4>
                                </div>
                            </a>
                        </div>
                        <!-- Row end -->
                    </div>
                </div>
                <!-- Row end -->

                <!-- Row start -->
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-12">
                        <div class="card light">
                            <div class="card-body">
                                @if (count($errors)>0)
                                    <div class="alert alert-danger text-white" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif

                                <h5 class="modal-title">
                                    <u>Editar Historia</u>
                                </h5>


                                <form action="{{ url('update-historia/'.$historia->paciente_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row gx-3">

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">¿FUE ENVIADO POR ALGUN MEDICO PARA SU VALORACION?</label>
                                                    <input name="medico" type="text" class="form-control" placeholder="Nombre..." value="{{$historia->medico }}"/>
                                                    @if ($errors->has('nombre'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('nombre') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label for="miembro_afectado" class="form-label">MIEMBRO AFECTADO</label>
                                                    <select name="miembro_afectado" class="form-select" aria-label="Default select example"/>
                                                            <option value="" {{ $historia->miembro_afectado == '' ? ' selected' : '' }}>Seleccione miembro...</option>
                                                            <option value="Derecho" {{ $historia->miembro_afectado == 'Derecho' ? ' selected' : '' }}>Derecho</option>
                                                            <option value="Izquierdo" {{ $historia->miembro_afectado == 'Izquierdo' ? ' selected' : '' }}>Izquierdo</option>
                                                            <option value="Ambos" {{ $historia->miembro_afectado == 'Ambos' ? ' selected' : '' }}>Ambos</option>
                                                    </select>
                                                    @if ($errors->has('miembro_afectado'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('miembro_afectado') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">PESO</label>
                                                    <div class="input-group">
                                                        <input name="peso" type="number" step="any" class="form-control" id="peso" placeholder="0.00"  value="{{ $historia->peso }}"/>
                                                        <span class="input-group-text">Lbs.</span>
                                                    </div>
                                                    @if ($errors->has('peso'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('peso') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">Estatura</label>
                                                    <div class="input-group">
                                                        <input name="estatura" type="number" step="any" class="form-control" id="estatura" placeholder="0.00"  value="{{ $historia->estatura }}">
                                                        <span class="input-group-text">Mts.</span>
                                                    </div>
                                                    @if ($errors->has('estatura'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('estatura') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">A. ¿ACUDE A CONSULTA POR?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Estetica</label>
                                                            <input name="a_estetica" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->a_estetica == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Enfermedad</label>
                                                            <input name="a_enfermedad" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->a_enfermedad == '1' ? 'checked' : '' }}>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">B. ¿CUALES SON LAS MOLESTIAS QUE SIENTE EN LAS PIERNAS?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Dolor en el muslo</label>
                                                            <input name="b_muslo" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_muslo == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Dolor en la pantorrilla</label>
                                                            <input name="b_pantorrilla" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_pantorrilla == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Dolor en el tobillo</label>
                                                            <input name="b_tobillo" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_tobillo == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <strong>Otras:</strong>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Varicorragia</label>
                                                            <input name="b_varicorragia" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_varicorragia == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Hinchazon</label>
                                                            <input name="b_inchazon" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_inchazon == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ulceras en la piel</label>
                                                            <input name="b_ulceras_piel" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_ulceras_piel == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ardor</label>
                                                            <input name="b_ardor" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_ardor == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Comezon</label>
                                                            <input name="b_comezon" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_comezon == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Cansancio</label>
                                                            <input name="b_cansancio" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_cansancio == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Pesadez</label>
                                                            <input name="b_pesadez" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_pesadez == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Calambres</label>
                                                            <input name="b_calambres" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->b_calambres == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        Describir Otros:
                                                        <input name="b_describir" type="text" class="form-control" placeholder="Describir otros sintomas..." value="{{$historia->b_describir }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">C. ¿EL DOLOR AUMENTA CON?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Al caminar</label>
                                                            <input name="c_caminar" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_caminar == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Periodos prolongados de pie</label>
                                                            <input name="c_periodos_prolongados_pie" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_periodos_prolongados_pie == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Calor</label>
                                                            <input name="c_calor" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_calor == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Menstruacion</label>
                                                            <input name="c_menstruacion" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_menstruacion == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ejercicio</label>
                                                            <input name="c_ejercicio" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_ejercicio == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Al elevar las piernas</label>
                                                            <input name="c_elevar_piernas" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_elevar_piernas == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Otros</label>
                                                            <input name="c_otros" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->c_otros == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        Cuales:
                                                        <input name="c_cuales" type="text" class="form-control" placeholder="Si activo 'Otros' describa cuales..." value="{{$historia->c_cuales }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">D. ¿EL DOLOR DISMINUYE CON?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Elevacion de las piernas</label>
                                                            <input name="d_elevacion_piernas" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->d_elevacion_piernas == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Medias elasticas</label>
                                                            <input name="d_medias_elasticas" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->d_medias_elasticas == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ejercicio</label>
                                                            <input name="d_ejercicio" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->d_ejercicio == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Mediamientos</label>
                                                            <input name="d_mediamientos" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->d_mediamientos == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        Cuales:
                                                        <input name="d_cuales" type="text" class="form-control" placeholder="Si activo 'Mediamientos' describa cuales..." value="{{$historia->d_cuales }}" />

                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">E. ¿ALGUIEN EN SU FAMILIA HA PADECIDO DE?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Varices</label>
                                                            <input name="e_varices" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->e_varices == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Flebitis</label>
                                                            <input name="e_flebitis" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->e_flebitis == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ulceras o llagas en las piernas</label>
                                                            <input name="e_ulceras_llagas_piernas" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->e_ulceras_llagas_piernas == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Trombosis</label>
                                                            <input name="e_trombosis" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->e_trombosis == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        ¿Quien?:
                                                        <input name="e_quien" type="text" class="form-control" placeholder="Quien de sus familiares..." value="{{$historia->e_quien }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">F. ¿TRATAMIENTOS VENOSOS PREVIOS?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <input name="f_tratamientos_venosos_previos" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->f_tratamientos_venosos_previos == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        Cuales:
                                                        <input name="f_cuales" type="text" class="form-control" placeholder="Si activo describa cuales..." value="{{$historia->f_cuales }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">G. ¿ES ALERGICO A LOS MEDICAMENTOS?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <input name="g_alergico" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->g_alergico == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        Cuales:
                                                        <input name="g_cuales" type="text" class="form-control" placeholder="Si activo describa cuales..." value="{{$historia->g_cuales }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">H. ¿LE HAN REALIZADO ALGUNA CIRUGIA(S)?</label>
                                                    <textarea name="h_cirugias" class="form-control" rows="6" placeholder="Descripción de la(s) cirugia(s)...">{{ $historia->h_cirugias }}</textarea>
                                                    @if ($errors->has('h_cirugias'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('h_cirugias') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">I. ¿SUFRE ALGUNA ENFERMEDAD? ¿CUALES? (DESCRIBALAS)</label>
                                                    <textarea id="i_enfermedades" class="form-control border px-2 class" name="i_enfermedades" rows="20">{!! html_entity_decode($historia->i_enfermedades) !!}</textarea>
                                                    <script>
                                                        ClassicEditor
                                                          .create(document.querySelector('#i_enfermedades'), {
                                                                ckfinder: {
                                                                    uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                }
                                                            })
                                                          .catch(error => {
                                                                console.error(error);
                                                            });
                                                    </script>
                                                    @if ($errors->has('i_enfermedades'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('i_enfermedades') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">J. FECHA ULTIMA REGLA</label>
                                                    <div class="input-group">
                                                        <input type="text" name="j_fecha_ultima_regla" class="form-control datepicker" id="j_fecha_ultima_regla" value="{{ $historia->j_fecha_ultima_regla }}"/>
                                                        <span class="input-group-text">
                                                            <i class="bi bi-calendar4"></i>
                                                        </span>
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
                                                            endDate: today,

                                                        };
                                                        $( '#j_fecha_ultima_regla' ).datepicker( optSimple );
                                                    </script>
                                                    Otro:
                                                    <input name="j_otro" type="text" class="form-control" placeholder="Otro..." value="{{$historia->j_otro }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">¿Esta tomando hormonas o anticonceptivos?</label>
                                                            <input name="j_hormonas_anticonceptivos" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->j_hormonas_anticonceptivos == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        Cuales:
                                                        <input name="j_cuales" type="text" class="form-control" placeholder="Si activo describa cuales..." value="{{$historia->j_cuales }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">K. ¿EN SU TRABAJO REQUIERE?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Estar mucho tiempo de pie</label>
                                                            <input name="k_tiempo_pie" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->k_tiempo_pie == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Estar mucho tiempo sentado</label>
                                                            <input name="k_tiempo_sentado" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->k_tiempo_sentado == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Estar expuesto al calor</label>
                                                            <input name="k_expuesto_calor" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->k_expuesto_calor == '1' ? 'checked' : '' }}>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">L. ¿USTED ACOSTUMBRA?</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Fumar</label>
                                                            <input name="l_fumar" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->l_fumar == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ingerir alcohol</label>
                                                            <input name="l_alcohol" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->l_alcohol == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Otros</label>
                                                            <input name="l_otros" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->l_otros == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <br>
                                                        Cuales:
                                                        <input name="l_cuales" type="text" class="form-control" placeholder="Cuales..." value="{{$historia->l_cuales }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">M. EMBARAZOS</label>
                                                    <input name="m_embarazos" type="number" class="form-control"  min="0" step="1" value="{{ $historia->m_embarazos }}">
                                                </div>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">¿Problemas durante el embarazo?</label>
                                                        <input name="m_problemas" type="text" class="form-control" placeholder="Si hubieron problemas describa cuales..." value="{{$historia->m_problemas }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">N. ¿ALGUNA INFORMACION QUE CONSIDERE PERTINENTE?</label>
                                                    <textarea name="n_informacion_pertinente" class="form-control" rows="6" placeholder="Información pertinente...">{{ $historia->n_informacion_pertinente }}</textarea>
                                                    @if ($errors->has('n_informacion_pertinente'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('n_informacion_pertinente') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">O. ¿EXPLORACION FISICA?</label>
                                                    <p>
                                                        Circunferencia MID:
                                                        <textarea name="o_circunferencia_mid" id="o_circunferencia_mid" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_circunferencia_mid) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_circunferencia_mid'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('n_informacion_pertinente'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('n_informacion_pertinente') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif
                                                        <br>
                                                        Circunferencia MII:
                                                        <textarea name="o_circunferencia_mii" id="o_circunferencia_mii" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_circunferencia_mii) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_circunferencia_mii'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_circunferencia_mii'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_circunferencia_mii') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Ulcera</label>
                                                            <input name="o_ulcera" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_ulcera == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_ulcera" id="o_ulcera" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_ulcera) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_ulcera'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_ulcera'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_ulcera') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Edema</label>
                                                            <input name="o_edema" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_edema == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_edema" id="o_edema" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_edema) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_edema'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_edema'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_edema') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Telangiectasias</label>
                                                            <input name="o_telangiectasias" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_telangiectasias == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_telangiectasias" id="o_telangiectasias" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_telangiectasias) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_telangiectasias'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_telangiectasias'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_telangiectasias') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}

                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Venas de pequeño tamaño</label>
                                                            <input name="o_venas_pequeno" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_venas_pequeno == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_venas_pequeno" id="o_venas_pequeno" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_venas_pequeno) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_venas_pequeno'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_venas_pequeno'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_venas_pequeno') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}

                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Venas de mediano tamaño</label>
                                                            <input name="o_venas_mediano" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_venas_mediano == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_venas_mediano" id="o_venas_mediano" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_venas_mediano) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_venas_mediano'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_venas_mediano'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_venas_mediano') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}

                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Venas de gran tamaño</label>
                                                            <input name="o_venas_gran" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_venas_gran == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_venas_gran" id="o_venas_gran" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_venas_gran) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_venas_gran'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_venas_gran'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_venas_gran') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}

                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Linfedema</label>
                                                            <input name="o_linfedema" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_linfedema == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_linfedema" id="o_linfedema" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_linfedema) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_linfedema'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_linfedema'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_linfedema') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}

                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Lipodermatoesclerosis</label>
                                                            <input name="o_lipodermatoesclerosis" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_lipodermatoesclerosis == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_lipodermatoesclerosis" id="o_lipodermatoesclerosis" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_lipodermatoesclerosis) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_lipodermatoesclerosis'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_lipodermatoesclerosis'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_lipodermatoesclerosis') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}

                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Hipersensibilidad</label>
                                                            <input name="o_hipersensibilidad" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->o_hipersensibilidad == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        {{-- <textarea name="o_hipersensibilidad" id="o_hipersensibilidad" class="form-control" rows="6" placeholder="">{!! html_entity_decode($historia->o_hipersensibilidad) !!}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                              .create(document.querySelector('#o_hipersensibilidad'), {
                                                                    ckfinder: {
                                                                        uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                    }
                                                                })
                                                              .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                        @if ($errors->has('o_hipersensibilidad'))
                                                            <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('o_hipersensibilidad') }}</font>
                                                                    </strong>
                                                            </span>
                                                        @endif --}}
                                                        <br>
                                                        Otros:
                                                        <input name="o_otros" type="text" class="form-control" placeholder="Otros..." value="{{ $historia->o_otros }}" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">P. ¿DIAGNOSTICO?</label>
                                                    <textarea id="p_diagnostico" class="form-control border px-2 class" name="p_diagnostico" rows="20">{!! html_entity_decode($historia->p_diagnostico) !!}</textarea>
                                                    <script>
                                                        ClassicEditor
                                                          .create(document.querySelector('#p_diagnostico'), {
                                                                ckfinder: {
                                                                    uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                }
                                                            })
                                                          .catch(error => {
                                                                console.error(error);
                                                            });
                                                    </script>
                                                    @if ($errors->has('p_diagnostico'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('p_diagnostico') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">Q. SOLICITAR DOPPLER</label>
                                                    <p>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Arterial</label>
                                                            <input name="q_arterial" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->q_arterial == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Venoso</label>
                                                            <input name="q_venoso" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->q_venoso == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">MII</label>
                                                            <input name="q_mii" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->q_mii == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">MID</label>
                                                            <input name="q_mid" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->q_mid == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Bilateral</label>
                                                            <input name="q_bilateral" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->q_bilateral == '1' ? 'checked' : '' }}>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">R. RESULTADO DE DOPPLER</label>
                                                    <textarea id="r_resultado_doppler" class="form-control border px-2 class" name="r_resultado_doppler" rows="20">{!! html_entity_decode($historia->r_resultado_doppler) !!}</textarea>
                                                    <script>
                                                        ClassicEditor
                                                          .create(document.querySelector('#r_resultado_doppler'), {
                                                                ckfinder: {
                                                                    uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                }
                                                            })
                                                          .catch(error => {
                                                                console.error(error);
                                                            });
                                                    </script>
                                                    @if ($errors->has('r_resultado_doppler'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('r_resultado_doppler') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <!-- Form Field Start -->
                                                <div class="mb-3">
                                                    <label class="form-label">S. TRATAMIENTO</label>
                                                    <textarea id="s_tratamiento" class="form-control border px-2 class" name="s_tratamiento" rows="20">{!! html_entity_decode($historia->s_tratamiento) !!}</textarea>
                                                    <script>
                                                        ClassicEditor
                                                          .create(document.querySelector('#s_tratamiento'), {
                                                                ckfinder: {
                                                                    uploadUrl: "{{ url('upload_imagen_historia') }}" + "?_token=" + "{{ csrf_token() }}"
                                                                }
                                                            })
                                                          .catch(error => {
                                                                console.error(error);
                                                            });
                                                    </script>
                                                    @if ($errors->has('s_tratamiento'))
                                                        <span class="help-block opacity-7">
                                                                <strong>
                                                                    <font color="red">{{ $errors->first('s_tratamiento') }}</font>
                                                                </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle"></i> Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-warning m-1">
                                            <i class="bi bi-check2-square"></i> Grabar
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
        </div>
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->

@endsection
