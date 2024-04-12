@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')

<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="frontendtemplate/img/face1.png" alt="Image">
                {{-- <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Keep Your Teeth Healthy</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">Take The Best Quality Dental Treatment</h1>
                        <a href="appointment.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Appointment</a>
                        <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                    </div>
                </div> --}}
            </div>
            <div class="carousel-item">
                <img class="w-100" src="frontendtemplate/img/face2.png" alt="Image">
                {{-- <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Keep Your Teeth Healthy</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">Take The Best Quality Dental Treatment</h1>
                        <a href="appointment.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Appointment</a>
                        <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                    </div>
                </div> --}}
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<!-- About Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title mb-4">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase">¿Quiénes somos?</h5>
                    <h1 class="display-5 mb-0">Flebo Center</h1>
                </div>
                <h4 class="text-body fst-italic mb-4">Líderes en el tratamiento de enfermedades venosas y linfáticas</h4>
                <p class="mb-4">En Flebo Center, nos dedicamos apasionadamente a mejorar la salud vascular de nuestros pacientes. Con más de 10 años de experiencia, somos líderes en el tratamiento de enfermedades venosas y linfáticas. Nuestro equipo de especialistas altamente capacitados está comprometido con la excelencia médica y la atención personalizada.</p>
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

<!-- Service Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5 mb-5">
            <div class="col-lg-5 wow zoomIn" data-wow-delay="0.3s" style="min-height: 400px;">
                <div class="twentytwenty-container position-relative h-100 rounded overflow-hidden">
                    <img class="position-absolute w-100 h-100" src="frontendtemplate/img/antes.jpg" style="object-fit: cover;">
                    <img class="position-absolute w-100 h-100" src="frontendtemplate/img/despues.jpg" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="section-title mb-5">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase">Nuestros Servicios</h5>
                    <h1 class="display-5 mb-0">Nuestro equipo de especialistas altamente capacitados está comprometido con la excelencia médica y la atención personalizada.</h1>
                </div>
                <div class="row g-5">
                    <div class="col-md-6 service-item wow zoomIn" data-wow-delay="0.6s">
                        <div class="rounded-top overflow-hidden">
                            <img class="img-fluid" src="frontendtemplate/img/drenajelinfatico.jpg" alt="">
                        </div>
                        <div class="position-relative bg-light rounded-bottom text-center p-4">
                            <h5 class="m-0">Drenaje Linfático</h5>
                        </div>
                    </div>
                    <div class="col-md-6 service-item wow zoomIn" data-wow-delay="0.9s">
                        <div class="rounded-top overflow-hidden">
                            <img class="img-fluid" src="frontendtemplate/img/face3.jpg" alt="">
                        </div>
                        <div class="position-relative bg-light rounded-bottom text-center p-4">
                            <h5 class="m-0">Flebología</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-7">
                <div class="row g-5">
                    <div class="col-md-6 service-item wow zoomIn" data-wow-delay="0.3s">
                        <div class="rounded-top overflow-hidden">
                            <img class="img-fluid" src="frontendtemplate/img/piediabitico.jpg" alt="">
                        </div>
                        <div class="position-relative bg-light rounded-bottom text-center p-4">
                            <h5 class="m-0">Pie Diabético</h5>
                        </div>
                    </div>
                    <div class="col-md-6 service-item wow zoomIn" data-wow-delay="0.6s">
                        <div class="rounded-top overflow-hidden">
                            <img class="img-fluid" src="frontendtemplate/img/presoterapia.jpg" alt="">
                        </div>
                        <div class="position-relative bg-light rounded-bottom text-center p-4">
                            <h5 class="m-0">Presoterapia</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 service-item wow zoomIn" data-wow-delay="0.9s">
                <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-4">
                    <h3 class="text-white mb-3">Programa una Cita</h3>
                    <p class="text-white mb-3">Llámanos o escríbenos al:</p>
                    <h2 class="text-white mb-0"><a class="text-white" href="https://wa.me/50257358668" target="_blank"><i class="fab fa-whatsapp fw-normal"></i> 5735 8668</a></h2>
                    <h2 class="text-white mb-0"><a class="text-white" href="tel:+50277677954" target="_blank"><i class="bi bi-telephone fw-normal"></i></i> 7767 7954</a></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

@endsection
