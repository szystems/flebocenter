@extends('layouts.frontend')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Servicios</h1>
                <a href="{{ url('/') }}" class="h4 text-white">Inicio</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h4 text-white">Servicios</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Pricing Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="section-title mb-4">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase">Servicios</h5>
                        <h1 class="display-5 mb-0">Atención Integral para el Cuidado de tu Bienestar</h1>
                    </div>
                    <p class="mb-4">En nuestra clínica, ofrecemos una amplia gama de servicios diseñados para atender tus necesidades de salud de manera integral. Nuestro equipo de profesionales altamente capacitados se dedica a proporcionar diagnósticos precisos y tratamientos efectivos en áreas como enfermedades venosas, cirugía general, fisioterapia y más. Desde el diagnóstico y tratamiento de condiciones como varices y linfedema, hasta técnicas avanzadas como la escleroterapia y la cirugía mínimamente invasiva, estamos comprometidos con tu salud y bienestar. Descubre cómo nuestros servicios pueden mejorar tu calidad de vida y contáctanos para agendar tu cita. Tu salud es nuestra prioridad.</p>
                    <h5 class="text-uppercase text-primary wow fadeInUp" data-wow-delay="0.3s">Llama para programar una cita</h5>
                    <h1 class="wow fadeInUp" data-wow-delay="0.6s"><a href="tel:+50277677954">Tel: 7767-7954</a></h1>
                </div>
                <div class="col-lg-12">
                    <div class="owl-carousel price-carousel wow zoomIn" data-wow-delay="0.9s">

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/26.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>DIAGNOSTICO Y TRATAMIENTO DE ENFERMEDADES VENO LINFATICAS</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Diagnóstico de enfermedad venosa</span></div>
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Tratamiento de varices </span></div>
                                <div class="d-flex justify-content-start mb-2"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Tratamiento de ulceras venosas</span></div>
                                <div class="d-flex justify-content-start mb-2"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Diagnóstico y tratamiento de linfedema</span></div>
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Diagnóstico y tratamiento de lipedema </span></div>
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Diagnóstico de otras enfermedades venosas y arteriales </span></div>
                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/2.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>DIAGNOSTICO VASCULAR NO INVASIVO (DUPLEX VASCULAR)</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Diagnostico mediante ultrasonido dúplex vascular, en el que se utiliza ultrasonido
                                    para evaluar anatomía y función de venas y arterias, el cual es el gold estándar para
                                    el diagnostico de enfermedades.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/27.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>CIRUGIA GENERAL</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/21.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>ESCLEROTERAPIA PARA EL TRATAMIENTO DE VARICES</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Tratamiento mediante el cual se administra una sustancia esclerosante en venas
                                    afectadas con la finalidad de interrumpir el flujo venoso en dichos vasos, el cual se
                                    puede realiza mediante la utilización de transiluminación o ultrasonido para
                                    mejorar la visibilidad de los vasos a tratar.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/28.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>CIRUGIA MINIMA MENTE INVASIVA PARA EL TRATAMIENTO DE VARICES</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> En pacientes con enfermedad venosa avanzada que requieran tratamiento
                                    quirúrgico, es posible realizar cirugía abierta mínimamente invasiva o cirugía laser
                                    si el paciente lo requiere.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/18.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>DIAGNOSTICO Y TRATAMIENTO DE LINFEDEMA</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> El linfedema es la afectación primaria o secundaria del sistema linfático,
                                    realizamos la evaluación clínica y ultrasonido para el diagnóstico.
                                    </span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/25.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>DRENAJE LINFATICO MANUAL</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Es una técnica especializada que se realiza de manera manual para poder
                                    descomprimir los ganglios linfáticos y estimular el flujo de linfa a través de los
                                    canales linfáticos.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/22.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>RADIOFRECUENCIA, ULTRASONIDO Y PRESOTERAPIA</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Son equipos de apoyo al drenaje linfático manual que nos ayudan a mejorar la
                                    función del sistema linfático y vascular.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/8.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>TRATAMIENTO DE LIPEDEMA Y CELULITIS</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> El lipedema es una condición que poco se diagnostica pero que provoca múltiples
                                    afecciones físicas y psicológicas en pacientes que la padecen y consiste en la
                                    acumulación anormal de grasa en partes específicas del cuerpo como las piernas y
                                    caderas, es dolorosa, provoca retención de líquidos, equimosis (moretones)
                                    espontáneos.</span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/9.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>TRATAMIENTO DE ULCERAS Y HERIDAS COMPLICADAS</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Utilizamos diferente técnicas para el tratamiento de ulceras y heridas complicadas
                                    de cualquier índole.
                                    </span></div>

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/11.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>TRATAMIENTO DE ENFERMEDADES UNGUEALES (UÑAS ENCARNADAS, HONGOS)
                                </h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                {{-- <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div> --}}

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/12.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>TRATAMIENTO DE HEMORROIDES</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                {{-- <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div> --}}

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/13.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>ELIMINACION DE VERRUGAS Y ACROCORDONES CON LASER</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                {{-- <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div> --}}

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/14.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>PIE DIABETICO
                                </h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                {{-- <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div> --}}

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/15.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>PEDICURA CLINICA </h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                {{-- <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div> --}}

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="frontendtemplate/img/enf/24.jpg" alt="">
                                {{-- <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0">$35</h2>
                                </div> --}}
                            </div>
                            <div class="position-relative text-start bg-light border-bottom border-primary py-5 p-4">
                                <h4>FISIOTERAPIA Y REHABILITACION</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                {{-- <div class="d-flex justify-content-start mb-3"><i class="fa fa-check text-primary pt-1"></i><span style="margin-left: 5px;"> Cirugía de apéndice, Vesícula, Hernias, Lipomas, Tumores.</span></div> --}}

                                {{-- <a href="appointment.html" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Appointment</a> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

@endsection
