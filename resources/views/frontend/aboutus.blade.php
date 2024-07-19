@extends('layouts.frontend')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Nosotros</h1>
                <a href="{{ url('/') }}" class="h4 text-white">Inicio</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h4 text-white">Nosotros</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title mb-4">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase">¿Quiénes somos?</h5>
                    <h1 class="display-5 mb-0">FLEBOCENTER</h1>
                </div>
                <h4 class="text-body fst-italic mb-4">Líderes en el tratamiento de enfermedades venosas y linfáticas</h4>
                <p class="mb-4">En FLEBOCENTER, nos dedicamos apasionadamente a mejorar la salud vascular de nuestros pacientes. Con más de 10 años de experiencia, somos líderes en el tratamiento de enfermedades venosas y linfáticas. Nuestro equipo de especialistas altamente capacitados está comprometido con la excelencia médica y la atención personalizada.</p>
                <p class="mb-4">Serán gustosamente atendidos por la <strong>Dra. Mirla Rodríguez</strong></p>
                <div class="row g-3">
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.3s">
                        <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Award Winning</h5>
                        <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Professional Staff</h5>
                    </div>
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                        <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>24/7 Opened</h5>
                        <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Fair Prices</h5>
                    </div>
                </div>
                <a href="https://wa.me/50257358668" class="btn btn-primary py-3 px-5 mt-4 wow zoomIn" data-wow-delay="0.6s" target="_blank">Hacer una Cita</a>
            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    {{-- <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="frontendtemplate/img/doctora.jpg" style="object-fit: cover;"> --}}
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="frontendtemplate/img/doctora.jpg" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="tel:+50277677954"><i class="bi bi-telephone fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="https://wa.me/50257358668" target="_blank"><i class="fab fa-whatsapp fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="https://www.facebook.com/flebocenterQuetzaltenango/" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="https://www.instagram.com/flebocenter_quetzaltenango/?utm_source=qr&igsh=OXAyZDl6Zjh1OHh4" target="_blank"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">Dra. Mirla Rodríguez</h4>
                            <p class="text-primary mb-0">Especialista en venas y pie diabético</p>
                            <p class="text-primary mb-0">Especialista en cirugía general, laparoscopía, flebología, y linfología</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
@endsection
