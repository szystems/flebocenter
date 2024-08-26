<!-- Modal -->
<div class="modal fade" id="editarHistoriaModal{{ $historia->paciente_id }}" tabindex="-1"
    aria-labelledby="editarHistoriaModal{{ $historia->paciente_id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarHistoriaModal{{ $historia->paciente_id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Historia
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ url('update-historia/'.$historia->paciente_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row gx-3">


                    <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">¿FUE ENVIADO POR ALGUN MEDICO PARA SU VALORACION?</label>
                                <input name="medico" type="text" class="form-control" placeholder="Nombre..." value="{{$historia->medigo }}" required/>
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
                                <select name="miembro_afectado" class="form-select" aria-label="Default select example" required>
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
                                    <input name="peso" type="number" class="form-control" id="peso" placeholder="0.00"  value="{{ $historia->peso }}" required>
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
                                    <input name="peso" type="number" class="form-control" id="peso" placeholder="0.00"  value="{{ $historia->peso }}" required>
                                    <span class="input-group-text">Mts.</span>
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
                                    <br>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enfermedad</label>
                                        <input name="a_enfermedad" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $historia->a_enfermedad == '1' ? 'checked' : '' }}>
                                      </div>
                                    Enfermedad: <strong>{{ $historia->a_enfermedad == '1' ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">B. ¿CUALES SON LAS MOLESTIAS QUE SIENTE EN LAS PIERNAS?</label>
                                <p>
                                    Dolor en el muslo: <strong>{{ $historia->b_muslo == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Dolor en la pantorrilla: <strong>{{ $historia->b_pantorrilla == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Dolor en el tobillo: <strong>{{ $historia->b_tobillo == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    <strong>Otras:</strong>
                                    <br>
                                    Dolor: <strong>{{ $historia->b_varicorragia == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Hinchazon: <strong>{{ $historia->b_inchazon == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ulceras en la piel: <strong>{{ $historia->b_ulceras_piel == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ardor: <strong>{{ $historia->b_ardor == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Comezon: <strong>{{ $historia->b_comezon == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cansancio: <strong>{{ $historia->b_cansancio == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Pesadez: <strong>{{ $historia->b_pesadez == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Calambres: <strong>{{ $historia->b_calambres == '1' ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">C. ¿EL DOLOR AUMENTA CON?</label>
                                <p>
                                    Al caminar: <strong>{{ $historia->c_caminar == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Periodos prolongados de pie: <strong>{{ $historia->c_periodos_prolongados_pie == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Calor: <strong>{{ $historia->c_calor == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Menstruacion: <strong>{{ $historia->c_menstruacion == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ejercicio: <strong>{{ $historia->c_ejercicio == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Al elevar las piernas: <strong>{{ $historia->c_elevar_piernas == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Otros: <strong>{{ $historia->c_otros == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cuales: <strong>{{ $historia->c_otros == null ? '' : $historia->c_otros }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">D. ¿EL DOLOR DISMINUYE CON?</label>
                                <p>
                                    Elevacion de las piernas: <strong>{{ $historia->d_elevacion_piernas == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Medias elasticas: <strong>{{ $historia->d_medias_elasticas == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ejercicio: <strong>{{ $historia->d_ejercicio == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Medicamentos: <strong>{{ $historia->c_menstruacion == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ejercicio: <strong>{{ $historia->c_ejercicio == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Al elevar las piernas: <strong>{{ $historia->c_elevar_piernas == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Mediamientos: <strong>{{ $historia->d_mediamientos == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cuales: <strong>{{ $historia->d_cuales == null ? '' : $historia->c_otros }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">E. ¿ALGUIEN EN SU FAMILIA HA PADECIDO DE?</label>
                                <p>
                                    Varices: <strong>{{ $historia->e_varices == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Flebitis: <strong>{{ $historia->e_flebitis == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ulceras o llagas en las piernas: <strong>{{ $historia->e_ulceras_llagas_piernas == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Trombosis: <strong>{{ $historia->e_trombosis == '1' ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">F. ¿TRATAMIENTOS VENOSOS PREVIOS?</label>
                                <p>
                                    <strong>{{ $historia->f_tratamientos_venosos_previos == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cuales: <strong>{{ $historia->f_tratamientos_venosos_previos == null ? '' : $historia->f_tratamientos_venosos_previos }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">G. ¿ES ALERGICO A LOS MEDICAMENTOS?</label>
                                <p>
                                    <strong>{{ $historia->g_alergico == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cuales: <strong>{{ $historia->g_cuales == null ? '' : $historia->g_cuales }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">H. ¿LE HAN REALIZADO ALGUNA CIRUGIA(S)?</label>
                                <p>
                                    <textarea class="form-control border px-2 class" rows="5">{{ $historia->h_cirugias == null ? 'Ninguna' : $historia->h_cirugias }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">I. ¿SUFRE ALGUNA ENFERMEDAD? ¿CUALES? (DESCRIBALAS)</label>
                                <p>
                                    <textarea class="form-control border px-2 class" rows="5">{{ $historia->i_enfermedades == null ? 'Ninguna' : $historia->i_enfermedades }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">J. FECHA ULTIMA REGLA</label>
                                <p>
                                    @php
                                        if ($historia->j_fecha_ultima_regla != null) {
                                            $fur = date("d/m/Y", strtotime($historia->fur));
                                        }
                                    @endphp
                                    {{ $historia->j_fecha_ultima_regla != null ? $historia->j_fecha_ultima_regla : 'No definido' }}
                                    <br>
                                    ¿Esta tomando hormonas o anticonceptivos? <strong>{{ $historia->j_hormonas_anticonceptivos == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cuales: <strong>{{ $historia->j_hormonas_anticonceptivos == null ? 'Ninguno' : $historia->j_hormonas_anticonceptivos }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">K. ¿EN SU TRABAJO REQUIERE?</label>
                                <p>
                                    Estar mucho tiempo de pie: <strong>{{ $historia->k_tiempo_pie == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Estar mucho tiempo sentado: <strong>{{ $historia->k_tiempo_sentado == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Estar expuesto al calor: <strong>{{ $historia->k_expuesto_calor == '1' ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">L. ¿USTED ACOSTUMBRA?</label>
                                <p>
                                    Fumar: <strong>{{ $historia->l_fumar == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Ingerir alcohol: <strong>{{ $historia->l_alcohol == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Otros: <strong>{{ $historia->l_otros == '1' ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">M. ¿PROBLEMAS DURANTE SUS EMBARAZOS?</label>
                                <p>
                                    <strong>{{ $historia->m_embarazos == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Cuales: <textarea class="form-control border px-2 class" rows="5">{{ $historia->m_problemas == null ? 'Ninguno' : $historia->m_problemas }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">N. ¿ALGUNA INFORMACION QUE CONSIDERE PERTINENTE?</label>
                                <p>
                                    <textarea class="form-control border px-2 class" rows="5">{{ $historia->n_informacion_pertinente == null ? 'Ninguno' : $historia->n_informacion_pertinente }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">O. ¿EXPLORACION FISICA?</label>
                                <p>
                                    Circunferencia MID: <strong>{{ $historia->o_circunferencia_mid == null ? 'Ninguno' : $historia->o_circunferencia_mid }}</strong>
                                    <br>
                                    Circunferencia MII: <strong>{{ $historia->o_circunferencia_mii == null ? 'Ninguno' : $historia->o_circunferencia_mii }}</strong>
                                    <br>
                                    Ulcera: <strong>{{ $historia->o_ulcera == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Edema: <strong>{{ $historia->o_edema == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Telangiectasias: <strong>{{ $historia->o_telangiectasias == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Venas de pequeño tamaño: <strong>{{ $historia->o_venas_pequeno == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Venas de mediano tamaño: <strong>{{ $historia->o_venas_mediano == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Venas de gran tamaño: <strong>{{ $historia->o_venas_gran == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Linfedema: <strong>{{ $historia->o_linfedema == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Lipodermatoesclerosis: <strong>{{ $historia->o_lipodermatoesclerosis == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Hipersensibilidad: <strong>{{ $historia->o_hipersensibilidad == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">P. ¿DIAGNOSTICO?</label>
                                <p>
                                    <textarea class="form-control border px-2 class" rows="5">{{ $historia->p_diagnostico == null ? 'Ninguno' : $historia->p_diagnostico }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">Q. SOLICITAR DOPPLER</label>
                                <p>
                                    Arterial: <strong>{{ $historia->q_arterial == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Venoso: <strong>{{ $historia->q_venoso == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    MII: <strong>{{ $historia->q_mii == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    MID: <strong>{{ $historia->q_mid == '1' ? 'Si' : 'No' }}</strong>
                                    <br>
                                    Bilateral: <strong>{{ $historia->q_bilateral == '1' ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">R. RESULTADO DE DOPPLER</label>
                                <p>
                                    <textarea class="form-control border px-2 class" rows="5">{{ $historia->r_resultado_doppler == null ? 'Ninguno' : $historia->r_resultado_doppler }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">S. TRATAMIENTO</label>
                                <p>
                                    <textarea class="form-control border px-2 class" rows="5">{{ $historia->s_tratamiento == null ? 'Ninguno' : $historia->s_tratamiento }}</textarea>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="historia"><strong>Historia</strong></label>
                                {{-- <textarea name="descripcion" class="form-control" rows="6" placeholder="Descripción de la historia...">{{ $historia->descripcion }}</textarea> --}}
                                <textarea id="edithistoria{{ $historia->paciente_id }}" class="form-control border px-2 class" name="descripcion" rows="20">{!! html_entity_decode($historia->descripcion) !!}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('descripcion') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check2-square"></i> Grabar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

