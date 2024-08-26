<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f0f0f0;
        }

        header {
            text-align: center;
        }

        header h1 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        section {
            margin-bottom: 20px;
        }

        section h2 {
            font-size: 14px;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        footer p {
            margin-bottom: 10px;
        }
        img {
        width: 100%;
        height: auto;
        margin: 0;
        padding: 0;
    }
    </style>
</head>

<body>
    <header>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
        <h1><u>Historia</u></h1>
        @php
                $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
                $horafecha = $horafecha->format('d-m-Y, H:i:s')
            @endphp
        <p>Fecha de impresion: {{ $horafecha }}</p>
    </header>
    <section>
        <h2>Paciente</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Ocupación</th>
                    <th>Nacimiento</th>
                    <th>Sexo</th>
                    <th>Tel./Cel.</th>
                    <th>Email</th>
                    <th>DPI</th>
                    <th>NIT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $historia->paciente->nombre }}</td>
                    <td>{{ $historia->paciente->ocupacion }}</td>
                    @php
                        $fnacimiento = null;
                        $edad = 0;
                        if ($historia->paciente->fecha_nacimiento != null) {
                            $fnacimiento = date("d/m/Y", strtotime($historia->paciente->fecha_nacimiento));
                            //calcular edad
                            $fecha_nacimiento = date("d-m-Y", strtotime($historia->paciente->fecha_nacimiento));
                            $cumpleanos = new DateTime($historia->paciente->fecha_nacimiento);
                            $hoy = new DateTime();
                            $annos = $hoy->diff($cumpleanos);
                            $edad = $annos->y;
                        }

                    @endphp
                    <td>{{ $fnacimiento }} ({{ $edad }} años)</td>
                    <td>{{ $historia->paciente->sexo }}</td>
                    <td>{{ $historia->paciente->telefono }} / {{ $historia->paciente->celular }}</td>
                    <td>{{ $historia->paciente->email }}</td>
                    <td>{{ $historia->paciente->dpi }}</td>
                    <td>{{ $historia->paciente->nit }}</td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Historia</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>¿FUE ENVIADO POR ALGUN MEDICO PARA SU VALORACION?</th>
                    <th>MIEMBRO AFECTADO:</th>
                    <th>PESO:</th>
                    <th>ESTATURA:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $historia->medico }}</td>
                    <td>{{ $historia->miembro_afectado }}</td>
                    <td>{{ $historia->peso }} Lbs.</td>
                    <td>{{ $historia->estatura }} Mts.</td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="8" align="center"><strong>Historia</strong></th>
                </tr>
                <tr>
                    <th colspan="3" align="right">¿FUE ENVIADO POR ALGUN MEDICO PARA SU VALORACION?</th>
                    <td colspan="5" align="left">{{ $historia->medico }}</td>
                </tr>
                <tr>
                    <th align="right">MIEMBRO AFECTADO:</th>
                    <td colspan="1" align="left">{{ $historia->miembro_afectado }}</td>
                    <th align="right">PESO:</th>
                    <td align="left">{{ $historia->peso }} Lbs.</td>
                    <th align="right">ESTATURA:</th>
                    <td colspan="3" align="left">{{ $historia->estatura }} Mts.</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">A. ¿ACUDE A CONSULTA POR?</th>
                </tr>
                <tr>
                    <th colspan="1" align="right">Estetica</th>
                    <td align="left">{{ $historia->a_estetica == '1' ? 'Si' : 'No' }}</td>
                    <th colspan="1" align="right">Enfermedad</th>
                    <td colspan="5" align="left">{{ $historia->a_enfermedad == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">B. ¿CUALES SON LAS MOLESTIAS QUE SIENTE EN LAS PIERNAS?</th>
                </tr>
                <tr>
                    <th align="right">Dolor en el muslo:</th>
                    <td align="center">{{ $historia->b_muslo == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Dolor en la pantorrilla:</th>
                    <td align="center">{{ $historia->b_pantorrilla == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Dolor en el tobillo:</th>
                    <td colspan="3" align="center">{{ $historia->b_tobillo == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">Otras:</th>
                </tr>
                <tr>
                    <th align="right">Dolor:</th>
                    <td align="center">{{ $historia->b_muslo == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Hinchazon:</th>
                    <td align="center">{{ $historia->b_pantorrilla == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Ulceras en la piel:</th>
                    <td align="center">{{ $historia->b_tobillo == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Ardor:</th>
                    <td align="center">{{ $historia->b_tobillo == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">Comezon:</th>
                    <td align="center">{{ $historia->b_comezon == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Cansancio:</th>
                    <td align="center">{{ $historia->b_cansancio == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Pesadez:</th>
                    <td align="center">{{ $historia->b_pesadez == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Calambres:</th>
                    <td align="center">{{ $historia->b_calambres == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">C. ¿EL DOLOR AUMENTA CON?</th>
                </tr>
                <tr>
                    <th align="right">Al caminar:</th>
                    <td align="center">{{ $historia->c_caminar == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Periodos prolongados de pie:</th>
                    <td align="center">{{ $historia->c_periodos_prolongados_pie == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Calor:</th>
                    <td align="center">{{ $historia->c_calor == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Menstruacion:</th>
                    <td align="center">{{ $historia->c_menstruacion == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">Ejercicio:</th>
                    <td align="center">{{ $historia->c_ejercicio == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Al elevar las piernas:</th>
                    <td colspan="5" align="center">{{ $historia->c_elevar_piernas == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">Otros:</th>
                    <td align="center">{{ $historia->c_otros == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Cuales:</th>
                    <td colspan="5" align="center">{{ $historia->c_cuales }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">D. ¿EL DOLOR DISMINUYE CON?</th>
                </tr>
                <tr>
                    <th align="right">Elevacion de las piernas:</th>
                    <td align="left">{{ $historia->d_elevacion_piernas == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Medias elasticas:</th>
                    <td align="left">{{ $historia->d_medias_elasticas == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Ejercicio:</th>
                    <td align="left" colspan="3">{{ $historia->d_ejercicio == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">Mediamientos:</th>
                    <td align="left">{{ $historia->d_mediamientos == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Cuales:</th>
                    <td align="left" colspan="5">{{ $historia->d_cuales }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">E. ¿ALGUIEN EN SU FAMILIA HA PADECIDO DE?</th>
                </tr>
                <tr>
                    <th align="right">Varices:</th>
                    <td align="center">{{ $historia->e_varices == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Flebitis:</th>
                    <td align="center">{{ $historia->e_flebitis == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Ulceras o llagas en las piernas:</th>
                    <td align="center">{{ $historia->e_ulceras_llagas_piernas == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Trombosis:</th>
                    <td align="center">{{ $historia->e_trombosis == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">F. ¿TRATAMIENTOS VENOSOS PREVIOS?</th>
                </tr>
                <tr>
                    <td align="center">{{ $historia->f_tratamientos_venosos_previos == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Cuales:</th>
                    <td align="center" colspan="6">{{ $historia->f_cuales }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">G. ¿ES ALERGICO A LOS MEDICAMENTOS?</th>
                </tr>
                <tr>
                    <td align="center">{{ $historia->g_alergico == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Cuales:</th>
                    <td align="center" colspan="6">{{ $historia->g_cuales }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">H. ¿LE HAN REALIZADO ALGUNA CIRUGIA(S)?</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">{{ $historia->h_cirugias }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">I. ¿SUFRE ALGUNA ENFERMEDAD? ¿CUALES? (DESCRIBALAS)</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">
                        @php
                            if ($historia->i_enfermedades) {
                                $texto = html_entity_decode($historia->i_enfermedades, ENT_COMPAT, 'UTF-8');
                                $texto = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $texto);
                                $dom = new DOMDocument('1.0', 'UTF-8');
                                $dom->loadHTML(mb_convert_encoding($texto, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_NOWARNING);
                                $imagenes = $dom->getElementsByTagName('img');
                                foreach ($imagenes as $imagen) {
                                    $imagen->removeAttribute('src');
                                }
                                $html = $dom->saveHTML();
                                $html = str_replace('&nbsp;', ' ', $html); // reemplazar &nbsp; por espacio normal
                                $html = htmlspecialchars_decode($html, ENT_COMPAT); // convertir entidades HTML a caracteres normales
                                echo utf8_encode($html); // agregar utf8_encode para asegurarse de que se muestre correctamente
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <th colspan="4" align="left">J. FECHA ULTIMA REGLA</th>
                    @php
                        if ($historia->j_fecha_ultima_regla != null) {
                            $fur = date("d/m/Y", strtotime($historia->fur));
                        }
                    @endphp
                    <td align="center" colspan="4">{{ $historia->j_fecha_ultima_regla != null ? $fur : 'No definido' }}</td>
                </tr>
                <tr>
                    <th align="right">¿Esta tomando hormonas o anticonceptivos?</th>
                    <td align="center">{{ $historia->j_hormonas_anticonceptivos	 }}</td>
                    <th align="right">¿Cuales?</th>
                    <td align="center" colspan="5">{{ $historia->j_cuales }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">K. ¿EN SU TRABAJO REQUIERE?</th>
                </tr>
                <tr>
                    <th align="right">Estar mucho tiempo de pie:</th>
                    <td align="center">{{ $historia->k_tiempo_pie == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Estar mucho tiempo sentado:</th>
                    <td align="center">{{ $historia->k_tiempo_sentado == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Estar expuesto al calor:</th>
                    <td align="center" colspan="3">{{ $historia->k_expuesto_calor == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">L. ¿USTED ACOSTUMBRA?</th>
                </tr>
                <tr>
                    <th align="right">Fumar:</th>
                    <td align="center">{{ $historia->l_fumar == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Ingerir alcohol:</th>
                    <td align="center">{{ $historia->l_alcohol == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Otros:</th>
                    <td align="center" colspan="3">{{ $historia->l_otros == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">¿Cuales?</th>
                    <td align="center" colspan="7">{{ $historia->l_cuales }}</td>
                </tr>
                <tr>
                    <th align="left" colspan="4">M. EMBARAZOS</th>
                    <td align="center" colspan="4">{{ $historia->m_embarazos >= '1' ? $historia->m_embarazos : 'No' }}</td>
                </tr>
                <tr>
                    <th align="left">¿Problemas durante sus embarazos?</th>
                    <td align="center" colspan="7">{{ $historia->m_problemas }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">N. ¿ALGUNA INFORMACION QUE CONSIDERE PERTINENTE?</th>
                </tr>
                <tr>
                    <td align="center" colspan="7">{{ $historia->n_informacion_pertinente }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">O. ¿EXPLORACION FISICA?</th>
                </tr>
                <tr>
                    <th colspan="8" align="left">Circunferencia MID:</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">
                        @php
                            if ($historia->o_circunferencia_mid) {
                                $texto = html_entity_decode($historia->o_circunferencia_mid, ENT_COMPAT, 'UTF-8');
                                $texto = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $texto);
                                $dom = new DOMDocument('1.0', 'UTF-8');
                                $dom->loadHTML(mb_convert_encoding($texto, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_NOWARNING);
                                $imagenes = $dom->getElementsByTagName('img');
                                foreach ($imagenes as $imagen) {
                                    $imagen->removeAttribute('src');
                                }
                                $html = $dom->saveHTML();
                                $html = str_replace('&nbsp;', ' ', $html); // reemplazar &nbsp; por espacio normal
                                $html = htmlspecialchars_decode($html, ENT_COMPAT); // convertir entidades HTML a caracteres normales
                                echo utf8_encode($html); // agregar utf8_encode para asegurarse de que se muestre correctamente
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <th colspan="8" align="left">Circunferencia MII:</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">
                        @php
                            if ($historia->o_circunferencia_mii) {
                                $texto = html_entity_decode($historia->o_circunferencia_mii, ENT_COMPAT, 'UTF-8');
                                $texto = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $texto);
                                $dom = new DOMDocument('1.0', 'UTF-8');
                                $dom->loadHTML(mb_convert_encoding($texto, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_NOWARNING);
                                $imagenes = $dom->getElementsByTagName('img');
                                foreach ($imagenes as $imagen) {
                                    $imagen->removeAttribute('src');
                                }
                                $html = $dom->saveHTML();
                                $html = str_replace('&nbsp;', ' ', $html); // reemplazar &nbsp; por espacio normal
                                $html = htmlspecialchars_decode($html, ENT_COMPAT); // convertir entidades HTML a caracteres normales
                                echo utf8_encode($html); // agregar utf8_encode para asegurarse de que se muestre correctamente
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <th align="right">Ulcera:</th>
                    <td align="center">{{ $historia->o_ulcera == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Edema:</th>
                    <td align="center">{{ $historia->o_edema == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Telangiectasias:</th>
                    <td align="center" colspan="3">{{ $historia->o_telangiectasias == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">Venas de pequeño tamaño:</th>
                    <td align="center">{{ $historia->o_venas_pequeno == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Venas de mediano tamaño:</th>
                    <td align="center">{{ $historia->o_venas_mediano == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Venas de gran tamaño:</th>
                    <td align="center" colspan="3">{{ $historia->o_venas_gran == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">Linfedema:</th>
                    <td align="center">{{ $historia->o_linfedema == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Lipodermatoesclerosis:</th>
                    <td align="center">{{ $historia->o_lipodermatoesclerosis == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Hipersensibilidad:</th>
                    <td align="center" colspan="3">{{ $historia->o_hipersensibilidad == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">P. ¿DIAGNOSTICO?</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">
                        @php
                            if ($historia->p_diagnostico) {
                                $texto = html_entity_decode($historia->p_diagnostico, ENT_COMPAT, 'UTF-8');
                                $texto = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $texto);
                                $dom = new DOMDocument('1.0', 'UTF-8');
                                $dom->loadHTML(mb_convert_encoding($texto, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_NOWARNING);
                                $imagenes = $dom->getElementsByTagName('img');
                                foreach ($imagenes as $imagen) {
                                    $imagen->removeAttribute('src');
                                }
                                $html = $dom->saveHTML();
                                $html = str_replace('&nbsp;', ' ', $html); // reemplazar &nbsp; por espacio normal
                                $html = htmlspecialchars_decode($html, ENT_COMPAT); // convertir entidades HTML a caracteres normales
                                echo utf8_encode($html); // agregar utf8_encode para asegurarse de que se muestre correctamente
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <th colspan="8" align="left">Q. SOLICITAR DOPPLER</th>
                </tr>
                <tr>
                    <th align="right">Arterial:</th>
                    <td align="center">{{ $historia->q_arterial == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Venoso:</th>
                    <td align="center">{{ $historia->q_venoso == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">MII:</th>
                    <td align="center" colspan="3">{{ $historia->q_mii == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th align="right">MID:</th>
                    <td align="center">{{ $historia->q_mid == '1' ? 'Si' : 'No' }}</td>
                    <th align="right">Bilateral:</th>
                    <td align="center" colspan="5">{{ $historia->q_bilateral == '1' ? 'Si' : 'No' }}</td>
                </tr>
                <tr>
                    <th colspan="8" align="left">R. RESULTADO DE DOPPLER</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">
                        @php
                            if ($historia->r_resultado_doppler) {
                                $texto = html_entity_decode($historia->r_resultado_doppler, ENT_COMPAT, 'UTF-8');
                                $texto = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $texto);
                                $dom = new DOMDocument('1.0', 'UTF-8');
                                $dom->loadHTML(mb_convert_encoding($texto, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_NOWARNING);
                                $imagenes = $dom->getElementsByTagName('img');
                                foreach ($imagenes as $imagen) {
                                    $imagen->removeAttribute('src');
                                }
                                $html = $dom->saveHTML();
                                $html = str_replace('&nbsp;', ' ', $html); // reemplazar &nbsp; por espacio normal
                                $html = htmlspecialchars_decode($html, ENT_COMPAT); // convertir entidades HTML a caracteres normales
                                echo utf8_encode($html); // agregar utf8_encode para asegurarse de que se muestre correctamente
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <th colspan="8" align="left">S. TRATAMIENTO</th>
                </tr>
                <tr>
                    <td align="center" colspan="8">
                        @php
                            if ($historia->s_tratamiento) {
                                $texto = html_entity_decode($historia->s_tratamiento, ENT_COMPAT, 'UTF-8');
                                $texto = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $texto);
                                $dom = new DOMDocument('1.0', 'UTF-8');
                                $dom->loadHTML(mb_convert_encoding($texto, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_NOWARNING);
                                $imagenes = $dom->getElementsByTagName('img');
                                foreach ($imagenes as $imagen) {
                                    $imagen->removeAttribute('src');
                                }
                                $html = $dom->saveHTML();
                                $html = str_replace('&nbsp;', ' ', $html); // reemplazar &nbsp; por espacio normal
                                $html = htmlspecialchars_decode($html, ENT_COMPAT); // convertir entidades HTML a caracteres normales
                                echo utf8_encode($html); // agregar utf8_encode para asegurarse de que se muestre correctamente
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <th colspan="8" align="left">AUTORIZO A LA DOCTORA</th>
                </tr>
                <tr>
                    <td align="left" colspan="8">
                        <P>
                            A inyectar un esclerosante en mis venas afectadas, con el propósito de tratar de mejorar los síntomas y apariencia de mis piernas. Entiendo que existen alternativas para el tratamiento de las varices como son los medicamentos y cirugías, me fue explicado y entiendo que dentro de los riesgos conocidos están los moretones, hinchazón de las piernas, pigmentación y necrosis de la piel, telangiectasias secundarias, reacción alérgica y estoy consciente que además de estos riesgos menores hay otros muy raros, como inflación de sistema venoso profundo y que una inyección intra arterial y la comprensión del nervio puede ocasionar una insensibilidad temporal. Conozco que la medicina no es una ciencia exacta y por consecuencia, un médico de reputación no puede garantizar resultados, tuve suficientes oportunidades para discutir mi condición y sobre el tratamiento sugerido por la doctora y todas mis preguntas fueron contestadas a satisfacción, yo creo que tengo el conocimiento suficiente sobre el cual me puedo apoyar a dar mi consentimiento al tratamiento de escleroterapia.
                        </P>
                    </td>
                </tr>
                <tr>
                    <th align="right">Nombre:</th>
                    <td align="center" colspan="3"></td>
                    <th align="right">Firma:</th>
                    <td align="center" colspan="3"></td>
                </tr>
            </thead>
        </table>
        <!-- Other sections... -->
    </section>

</body>

</html>
