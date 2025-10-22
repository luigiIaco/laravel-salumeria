<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salumeria')</title>
    <link rel="icon" href="{{ asset('images/logo/logoSalumeria.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;

        }

        body {
            background-color: #D8B384;
            font-family: 'Dancing Script', cursive;
        }

        a {
            color: #5A3E2B;
        }

        .birthstone-regular {
            font-family: "Birthstone", cursive;
            font-weight: 400;
            font-style: normal;
        }

        .opacity {
            opacity: 0.5;
            pointer-events: none;
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            animation: scaleIn 0.6s ease forwards;
            transform-origin: top center;
        }

        .avatar-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            background-color: white;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            margin-left: 9px;
        }

        .avatar-circle:hover {
            transform: scale(1.1);
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        a {
            text-decoration: none;
            font-size: 20px;
        }

        .modalError {
            /* nascosta di default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Contenuto modale */
        .modalContent {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            position: relative;
        }

        /* Pulsante chiudi */
        .modalError .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="birthstone-regular">

    <nav class="navbar navbar-expand-lg p-3 navbar-dark bg-dark flex flex-col @if (Route::is('home')) scale-in @endif">
        <!-- Logo -->
        <div class="flex">
            <a class="navbar-brand d-flex align-items-center ml-3 absolute left-0" href="{{ url('/') }}">
                <img width="60" src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo" style="margin-top: -9px;">
                <!-- Optional: testo accanto al logo -->
                <!-- <span class="ms-2">Salumeria</span> -->
            </a>

            <div class="absolute right-4 top-4 fs-4" style="color:#B3543E">
                @guest
                <p>
                    Login
                    <a href="{{ url('/login') }}">
                        <i class="fa-solid fa-right-to-bracket" style="cursor: pointer;"></i>
                    </a>
                </p>
                @endguest

                @auth
                <div class="flex">
                    Ciao, {{ Auth::user()->name }}
                    <el-dropdown class="inline-block">
                        <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md px-3 text-sm font-semibold text-gray-900 shadow-xs">
                            @if (!Auth::user()->imageProfile)
                            <div class="avatar-circle" id="circleImage"><i class="fa-solid fa-user fa-lg" style="color: #c3c6d1;"></i></div>
                            @else
                            <img
                                src="{{ asset('storage/' . Auth::user()->imageProfile) }}"
                                alt="Avatar"
                                class="w-12 h-12 rounded-full object-cover">
                            @endif
                        </button>

                        <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Dati Anagrafici</a>
                                @if (!Auth::user()->imageProfile)
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden" data-bs-toggle="modal" data-bs-target="#uploadModal"> Aggiungi immagine</a>
                                @else
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden" data-bs-toggle="modal" data-bs-target="#uploadModal"> Cambia immagine</a>
                                @endif
                                <a href="{{route('page.cart')}}" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Carrello</a>
                                <form action="{{ route('logoutUser') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-red-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                        Sign out
                                    </button>
                                </form>

                            </div>
                        </el-menu>
                    </el-dropdown>
                </div>
                <form id="logout-form" action="" method="POST" style="display:none;">
                    @csrf
                </form>
                @endauth
            </div>

            <!-- Link affiancati -->
            <ul class="navbar-nav d-flex justify-content-center ms-4 w-100">
                <li class="nav-item me-3">
                    <a class="nav-link" style="font-size: 25px;" href="{{ url('/products') }}">Prodotti</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" style="font-size: 25px;" href="{{ url('/') }}">Chi Siamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="font-size: 25px;" href="{{ url('/') }}">Contattaci</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Modal Upload Immagine -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="uploadModalLabel">Carica immagine profilo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>

                <div class="modal-body text-center">
                    <form action="{{ route('uploadAvatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Immagine di anteprima -->
                        <div class="mb-3 hidden" id="containerAnteprima">
                            <img id="previewImage"
                                src=""
                                alt="Anteprima immagine"
                                class="shadow-sm"
                                style="width: 120px; height: 120px; object-fit: cover; margin-bottom: 15px; margin: 0 auto;">
                        </div>

                        <!-- Input file -->
                        <div class="mb-3">
                            <input
                                type="file"
                                class="form-control"
                                id="avatarInput"
                                name="imageProfile"
                                accept="image/*"
                                required>
                        </div>

                        <button type="submit" class="btn w-100 text-white" style="background-color:#B3543E; border:none;">
                            Carica immagine
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-100 bg-dark text-white text-center py-3">
        <p class="mb-0">© {{ date('Y') }} Salumeria Bella Vita - Tutti i diritti riservati</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('avatarInput');
            const preview = document.getElementById('previewImage');

            input.addEventListener('change', function(e) {
                document.getElementById('containerAnteprima').classList.remove('hidden');
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>