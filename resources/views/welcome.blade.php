@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
{{-- Include Font Awesome for social media icons. In a real Laravel app, this would be in layouts/app.blade.php --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<section class="hero">
    {{-- Assuming /images/imagen01tienda.png exists in your public directory --}}
    <img src="/images/imagen01tienda.png" alt="Modelo de la Tienda" class="hero-model-image">

    <div class="hero-content-single-column">
        <h1>¡La Moda del Futuro ya está Aquí!</h1>
        <p class="lead"> Descubre las últimas tendencias ecológicas y eleva tu estilo con nuestras colecciones exclusivas recicladas.</p>
        <div class="hero-buttons d-flex flex-wrap justify-content-center align-items-center gap-3">
            <a href="{{ route('productos.index') }}" class="btn btn-black btn-lg rounded-pill">Explorar Colección</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg rounded-pill">Crear Cuenta</a>

            {{-- Social Media Buttons --}}
            <a href="https://www.tiktok.com/@ecocart3?_t=ZM-8xTt1eAKfNF&_r=1" target="_blank" class="btn btn-dark btn-lg rounded-circle" aria-label="TikTok">
                <i class="fab fa-tiktok"></i>
            </a>
            <a href="https://www.instagram.com/ecoc_art?igsh=Z3BjaWYwdWQwczJv" target="_blank" class="btn btn-dark btn-lg rounded-circle" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://wa.me/qr/NMCGWX3XAKYGJ1" target="_blank" class="btn btn-success btn-lg rounded-circle" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>

</section>

<section class="container my-5 py-5 bg-light rounded-4 shadow">
    <div class="row align-items-center">
        <div class="col-md-5 text-center mb-4 mb-md-0">
            <img src="{{ asset('images/logo-hydra.jpg') }}" class="img-fluid rounded-4 shadow-sm" alt="EcoCart Logo" style="max-height: 250px;">
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold mb-3">Nosotros: <span class="text-success">EcoCart</span></h2>
            <p class="lead text-justify">
                <strong>EcoCart</strong> es un emprendimiento comprometido con el medio ambiente, donde creamos carteras únicas a partir de casacas recicladas. Fusionamos moda, conciencia ecológica y creatividad artesanal.
            </p>
            <p class="text-justify">
                Cada una de nuestras piezas tiene una historia, una segunda vida y una causa. Al elegir EcoCart, estás apoyando un estilo sostenible, responsable y con propósito. ¡Transformamos ropa en arte, y arte en impacto!
            </p>

            <div class="mt-4 text-center text-md-start">
                <a href="{{ route('productos.index') }}" class="btn btn-lg btn-success px-4 rounded-pill shadow-sm">
                    🌿 Ver todos los productos
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

