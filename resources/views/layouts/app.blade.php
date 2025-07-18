<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MI TIENDA')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa; /* Fondo general claro */
            min-height: 100vh;
            margin: 0; /* Para que la navbar abarque todo el ancho y se pegue al top */
            padding: 0;
            overflow-x: hidden; /* Evita scroll horizontal */
        }

        .navbar-wrapper {
            /* Capa Exterior: Color de fondo, ABARCA TODO EL ANCHO, solo bordes inferiores redondeados */
            background: #e4eaf0; /* Color gris-azul claro para el fondo exterior */
            border-radius: 0 0 20px 20px; /* Solo bordes inferiores redondeados */
            padding: 25px 0; /* Aumentamos el padding vertical para dar espacio a la tarjeta flotante */
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: center;
            align-items: center; /* Centrar verticalmente la tarjeta flotante */
            width: 100%; /* Ocupa todo el ancho de la pantalla */
            box-sizing: border-box;
            position: relative;
            min-height: 120px; /* Altura mínima para que la tarjeta flotante se vea bien */
        }

        .main-nav-container {
            /* Capa Interior Principal: La "Tarjeta Flotante" blanca */
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%; /* Ajusta el ancho para que el fondo exterior se vea a los lados */
            max-width: 1100px; /* Ancho máximo para la tarjeta */
            height: 70px; /* Altura fija para la tarjeta */
            padding: 0 2rem; /* Padding interno para el contenido */
            box-sizing: border-box;
            border-radius: 40px; /* Bordes muy redondeados para la forma de "pastilla" */
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); /* Sombra más pronunciada para efecto flotante */
            z-index: 1; /* Asegura que esté por encima del fondo */
            transform: translateY(0);
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .main-nav-container:hover {
            transform: translateY(-5px); /* Se eleva un poco más */
            box-shadow: 0 15px 40px rgba(0,0,0,0.2); /* Sombra más grande */
        }

        /* Estilos para el LOGO como botón */
        .main-nav-container .logo-link {
            text-decoration: none; /* Quitar subrayado del enlace */
            color: inherit; /* Heredar color de texto (aunque lo definiremos en h4) */
            display: flex; /* Para centrar el texto h4 dentro del enlace */
            align-items: center;
            height: 100%; /* Ocupa toda la altura disponible para el clic */
            padding: 0 1rem; /* Espacio de clic alrededor del texto */
            cursor: pointer; /* Indica que es clickable */
        }

        .main-nav-container .logo-link h4 {
            font-weight: 800;
            letter-spacing: 2px;
            color: #000;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .main-nav-left, .main-nav-right {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }

        .main-nav-left {
            justify-content: flex-start;
        }

        .main-nav-right {
            justify-content: flex-end;
        }

        .main-nav-left a, .main-nav-right a {
            font-weight: 500;
            text-decoration: none;
            color: #000;
            margin: 0 0.75rem;
            transition: color 0.3s ease;
        }

        .main-nav-left a:hover, .main-nav-right a:hover {
            color: #555;
        }

        /* Estilos de la sección Hero con la imagen del modelo centrada */.hero {
    position: relative;
    height: 85vh;
    display: flex;
    align-items: center; /* Centra el contenido verticalmente */
    color: #fff;
    background: #e4eaf0;
    overflow: hidden;
}

.hero {
    position: relative;
    height: 85vh;
    display: flex;
    align-items: center; /* Centra el contenido verticalmente */
    color: #fff;
    background: #e4eaf0;
    overflow: hidden;
}

.hero-model-image {
    position: absolute;
    bottom: 0;
    /* CAMBIO CLAVE: Posicionar la imagen en el lado izquierdo y centrarla horizontalmente en ese lado */
    left: 20%; /* Ajusta este valor para el centrado. 0% la pega a la izquierda, 20% la mueve más al centro del lado izquierdo. */
    transform: translateX(-50%); /* Este es crucial: centra la imagen sobre el punto 'left' */
    right: auto; /* Asegura que no haya conflicto con 'right' */
    max-width: 100%;
    height: auto;
    max-height: 100%;
    z-index: 1; /* Encima del fondo, debajo del texto */
    object-fit: contain; /* O cover, dependiendo de tu imagen y preferencias */
    /* Opcional: Si la imagen es demasiado grande y se come el texto */
    /* max-width: 45%; */ /* Podrías reducir esto si es necesario */
}

/* Contenedor para la única columna de texto */
.hero-content-single-column {
    position: relative;
    z-index: 2; /* Asegura que el contenido esté sobre el modelo */
    padding: 2.5rem 3.5rem; /* Padding interno para la caja de texto */
    max-width: 550px; /* Ancho máximo para la caja de texto. Si quieres que sea más angosta, redúcelo. */
    text-align: left; /* Texto alineado a la izquierda dentro del card */
    background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente */
    border-radius: 20px; /* Bordes redondeados */
    backdrop-filter: blur(8px); /* Efecto de cristal */
    box-shadow: 0 15px 40px rgba(0,0,0,0.4); /* Sombra para que flote */

    /* POSICIONAMIENTO CLAVE: Centrar esta caja en el espacio disponible a la DERECHA */
    margin-left: auto; /* Empuja la caja de texto a la derecha */
    margin-right: auto; /* Y también la empuja a la izquierda, logrando el centrado en el espacio restante */
    /* NOTA: El 'max-width' es crucial para que se vea centrado en su propio espacio y no ocupe todo el ancho disponible */
}

/* Mantén los estilos de h1, p.lead, y botones como los tenías */
.hero-content-single-column h1 {
    font-size: 3.8rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    letter-spacing: 1px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-content-single-column p.lead {
    font-size: 1.4rem;
    margin-bottom: 2.5rem;
    font-weight: 300;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

.hero-content-single-column .hero-buttons {
    display: flex;
    justify-content: flex-start;
    gap: 1rem;
}

.hero-content-single-column .hero-buttons .btn {
    padding: 0.8rem 2.5rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-width: 2px;
    transition: all 0.3s ease;
}

.hero-content-single-column .hero-buttons .btn-black {
    background-color: #000;
    color: white;
    border-color: #000;
}

.hero-content-single-column .hero-buttons .btn-black:hover {
    background-color: transparent;
    color: #fff;
    border-color: #fff;
}

.hero-content-single-column .hero-buttons .btn-outline-primary {
    border-color: #fff;
    color: #fff;
}

.hero-content-single-column .hero-buttons .btn-outline-primary:hover {
    background-color: #fff;
    color: #000;
}

/* Animaciones (se mantienen igual) */
@keyframes fadeInSlideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-content-single-column h1 {
    animation: fadeInSlideUp 0.8s ease-out forwards;
}

.hero-content-single-column p.lead {
    animation: fadeInSlideUp 0.8s ease-out 0.2s forwards;
}

.hero-content-single-column .hero-buttons {
    animation: fadeInSlideUp 0.8s ease-out 0.4s forwards;
}

/* --- Media Queries para Responsividad (IMPORTANTES, se mantienen igual) --- */
@media (max-width: 992px) {
    .hero {
        flex-direction: column; /* Apila el modelo y el texto en pantallas pequeñas */
        justify-content: flex-end; /* Mantiene la imagen abajo */
    }
    .hero-model-image {
        left: 50%; /* Centra la imagen horizontalmente en móviles */
        transform: translateX(-50%);
        max-height: 80%;
        right: auto; /* Asegura que no haya conflicto */
    }
    .hero-content-single-column {
        max-width: 90%;
        margin-left: auto; /* Centra el bloque de texto en móviles */
        margin-right: auto;
        margin-bottom: 20vh;
        text-align: center;
        padding: 2rem;
    }
    .hero-content-single-column .hero-buttons {
        justify-content: center;
    }
    .hero-content-single-column h1 {
        font-size: 2.8rem;
    }
    .hero-content-single-column p.lead {
        font-size: 1.1rem;
    }
}


/* --- Estilos para el Historial de Compras --- */
.card.historial-item {
    border: 1px solid #dee2e6; /* Borde más sutil */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); /* Sombra más pronunciada para el efecto de "flotando" */
    transition: transform 0.3s ease-out, box-shadow 0.3s ease-out; /* Transición suave al pasar el mouse */
    overflow: hidden; /* Asegura que los bordes redondeados se apliquen bien */
}

.card.historial-item:hover {
    transform: translateY(-5px); /* Se eleva un poco al pasar el mouse */
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12); /* Sombra más grande al pasar el mouse */
}

.card.historial-item .card-header {
    background-color: #007bff; /* Color primario de Bootstrap para el header */
    color: white;
    font-weight: 600;
    padding: 1rem 1.5rem; /* Ajuste de padding */
    border-bottom: none; /* Quitar el borde inferior por defecto */
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 0.5rem 0.5rem 0 0; /* Bordes redondeados solo arriba */
}

.card.historial-item .card-header strong {
    font-size: 1.1rem;
}

.card.historial-item .card-header .btn-light {
    background-color: rgba(255, 255, 255, 0.2); /* Fondo transparente para el botón */
    border-color: rgba(255, 255, 255, 0.3); /* Borde sutil */
    color: white;
    padding: 0.4rem 1.2rem;
    font-weight: 500;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.card.historial-item .card-header .btn-light:hover {
    background-color: white; /* Fondo blanco al pasar el mouse */
    color: #007bff; /* Color primario al pasar el mouse */
}

.card.historial-item .list-group-item {
    background-color: #ffffff; /* Fondo blanco para los items de la lista */
    border-color: #e9ecef; /* Borde más claro */
    padding: 0.8rem 1.5rem; /* Ajuste de padding */
    font-size: 0.95rem;
}

.card.historial-item .list-group-item:last-child {
    border-bottom-left-radius: calc(0.5rem - 1px); /* Asegura bordes redondeados en el último item si la tarjeta tiene rounded-4 */
    border-bottom-right-radius: calc(0.5rem - 1px);
}

.card.historial-item .list-group-item.fw-bold {
    background-color: #f1f5f9; /* Un gris azulado muy claro para el total */
    font-size: 1rem;
    border-top: 1px dashed #ced4da; /* Línea de guiones para separar el total */
}

.alert.alert-info {
    border-radius: 0.75rem;
    padding: 1.5rem;
    font-size: 1.1rem;
    background-color: #e0f2f7; /* Un tono de azul más amigable */
    color: #0056b3; /* Texto azul oscuro */
    border-color: #b3e0ed;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

/* Animación de entrada para las tarjetas (opcional, pero da un toque pro) */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card.historial-item {
    animation: fadeInUp 0.5s ease-out forwards;
    /* Para que cada tarjeta aparezca con un pequeño retraso */
    /* Usaremos esto directamente en el foreach en el HTML si queremos staggered delays */
}

/* Ajuste general para el contenedor de la vista */
.container.mt-4.historial-container {
    padding-top: 30px; /* Más espacio arriba */
    padding-bottom: 50px; /* Más espacio abajo */
}

.historial-container h3 {
    font-size: 2.2rem; /* Título más grande */
    color: #343a40; /* Color de texto oscuro */
    margin-bottom: 2.5rem; /* Más espacio debajo del título */
    text-align: center; /* Centrar el título */
    letter-spacing: 0.5px;
}

        /* Animación de entrada para el hero content */
        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content h1 {
            animation: fadeInSlideUp 0.8s ease-out forwards;
        }

        .hero-content p.lead {
            animation: fadeInSlideUp 0.8s ease-out 0.2s forwards;
        }

        .hero-buttons {
            animation: fadeInSlideUp 0.8s ease-out 0.4s forwards;
        }

        /* Estilos específicos para los iconos y botones de la navbar */
        .main-nav-right .nav-item {
            list-style: none;
            margin: 0 0.75rem;
        }

        .main-nav-right .nav-link {
            color: #000;
            font-weight: 500;
        }

        .main-nav-right .btn.rounded-pill {
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            margin-left: 0.5rem;
        }

        .main-nav-right .btn-dark {
            background-color: #000;
            border-color: #000;
            color: white;
        }

        .main-nav-right .btn-dark:hover {
            background-color: #333;
            border-color: #333;
        }

        .main-nav-right .fs-5 {
            color: #fff;
            background-color: #000;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 0.5rem;
            font-size: 1rem !important;
        }
    </style>
</head>
<body>
    <!-- Script de Bootstrap, justo antes de cerrar el body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar completa -->
    <header class="navbar-wrapper">
        <div class="main-nav-container">
            <!-- IZQUIERDA -->
            <div class="main-nav-left">

                <a href="{{ route('productos.index') }}" >Nuevo</a>

             @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('usuarios.index') }}" >Mis clientes</a>
                @endif
            @endauth

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('ventas.dashboard') }}" class="btn btn-outline-info">📊 Ver Dashboard</a>
                @endif
            @endauth
            </div>

            <!-- LOGO CENTRAL AHORA FUNCIONA COMO BOTÓN -->
            <a href="{{ url('/') }}" class="logo-link">
                <h4 class="fw-bold m-0">EcoCart</h4>
            </a>

            <!-- DERECHA -->
            <div class="main-nav-right">
                @auth
                    @if(auth()->user()->role === 'cliente')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ventas.mis') }}">🧾 Mis Boletas</a>
                        </li>
                    @elseif(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ventas.todas') }}">🧾 Todas las Boletas</a>
                            </li>
                        @endif
                    @endauth

                    <a href="{{ route('productos.index') }}" >Ver productos</a>
                    @auth
                        @if(auth()->user()->role === 'cliente')
                            @php
                                $carrito = session('carrito', []);
                                $cantidadTotal = array_sum(array_column($carrito, 'cantidad'));
                            @endphp
                            <button class="btn btn-outline-dark btn-sm rounded-pill px-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalCarrito">
                                🛒 ({{ $cantidadTotal }})
                            </button>
                        @endif
                    @endauth

                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-dark btn-sm rounded-pill px-3 ms-2">SALIR</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-dark btn-sm rounded-pill px-3 ms-2">iniciar sesion</a>
                        <a href="{{ route('register') }}" class="btn btn-dark btn-sm rounded-pill px-3 ms-2">Registrate</a>
                        <span class="ms-2 fs-5">🔒</span>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Aquí se inyectan los contenidos específicos de cada vista -->
        <main>
            @yield('content')
        </main>

        <!-- Modal del carrito -->
        <div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold" id="modalCarritoLabel">🛒 Mi carrito</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        @if(session('carrito') && count(session('carrito')) > 0)
                            <table class="table table-sm text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cant.</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach(session('carrito') as $item)
                                        @php
                                            $subtotal = $item['precio'] * $item['cantidad'];
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $item['nombre'] }}</td>
                                            <td>S/. {{ number_format($item['precio'], 2) }}</td>
                                            <td>{{ $item['cantidad'] }}</td>
                                            <td>S/. {{ number_format($subtotal, 2) }}</td>
                                            <td>
                                                <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">🗑️</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="fw-bold table-light">
                                        <td colspan="3">Total</td>
                                        <td colspan="2">S/. {{ number_format($total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                                <form action="{{ route('checkout.form') }}" method="GET">
                                    <button class="btn btn-success btn-lg">Confirmar compra 🧾</button>
                                </form>
                        @else
                            <p class="text-center text-muted">Tu carrito está vacío 😢</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </body>
    </html>
