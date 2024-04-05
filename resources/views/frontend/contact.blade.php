@extends('layouts.frontend')
@section('content')

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Contacto</h1>
                <a href="{{ url('/') }}" class="h4 text-white">Inicio</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h4 text-white">Contacto</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase">Contacto</h5>
                            <h1 class="display-6 mb-4">Contáctanos en:</h1>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Clinica</h5>
                                <span><a href="https://maps.app.goo.gl/DzYtiBfeCvPWS8rE6" target="_blank"> Condado Santa María, <br>Edificio Imperia, <br>3er. Nivel, Clinica 6.</a></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Email</h5>
                                <span><a href="mailto:info@flebocenter.com" target="_blank">info@flebocenter.com</a></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Llamanos</h5>
                                <span><a href="tel:+50277677954" target="_blank">7767 7954</a></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-whatsapp fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Escribenos</h5>
                                <span><a href="https://wa.me/50257358668" target="_blank">5735 8668</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form action="{{ url('send-contact-email') }}" method="GET" class="contact-form mb-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <input name="name" type="text" class="form-control border-0 bg-light px-4" placeholder="Tu Nombre" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input name="email" type="email" class="form-control border-0 bg-light px-4" placeholder="Tu Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input name="phone" type="tel" class="form-control border-0 bg-light px-4" placeholder="Tu Teléfono" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input name="subject" type="text" class="form-control border-0 bg-light px-4" placeholder="Asunto" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea name="mensaje" class="form-control border-0 bg-light px-4 py-3" rows="5" placeholder="Mensaje"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.489896171921!2d-91.535692!3d14.853860099999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x858e99f3311840ad%3A0x8631f1fc75f078bd!2sFlebocenter!5e0!3m2!1ses-419!2sgt!4v1709917873176!5m2!1ses-419!2sgt"

                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
