<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antica Salumeria</title>
    <link rel="icon" href="{{ asset('images/logo/logoSalumeria.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;

        }

        body {
            background-color: #D8B384;
        }

        a {
            color: #5A3E2B;
        }


        .smooch-sans-regular {
            font-family: "Smooch Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
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

        .card {
            background: #fff8f0;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 420px;
            width: 100%;
            padding: 40px 30px;
            overflow: hidden;
        }

        .card h2 {
            color: #8B0000;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card p {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
        }

        .link {
            position: relative;
            display: inline-block;
            color: #8B0000;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #8B0000;
            transition: width 0.3s ease;
        }

        .link-login:hover::after {
            width: 100%;
        }

        .link-login:hover {
            color: #A01A1A;
        }

        .logo {
            display: block;
            margin: 0 auto 1.5rem;
            width: 100px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-underline {
            position: relative;
            display: inline-block;
            color: #8B0000;
            /* colore testo */
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .btn-underline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            /* distanza dalla scritta */
            width: 0;
            height: 2px;
            /* spessore della linea */
            background-color: #8B0000;
            transition: width 0.3s ease;
        }

        .btn-underline:hover::after {
            width: 100%;
            /* la linea si estende sotto tutto il testo */
        }

        .btn-underline:hover {
            color: #a01a1a;
            /* opzionale, cambia colore del testo */
        }

        @keyframes popIn {
            0% {
                transform: scale(1);
            }

            60% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .back-button {
            position: absolute;
            top: 45%;
            left: 2%;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 50px;
            padding: 12px 22px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow: hidden;
            opacity: 1;
            transform: translateX(-30px);
            animation: slideInLeft 0.6s ease forwards 0.4s;
            animation: popIn 1.5s ease-in-out infinite;
        }

        .back-button i {
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .back-button:hover i {
            transform: translateX(-5px);
        }

        /* Effetto luce */
        .back-button::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, 0.5) 50%, transparent 100%);
            transition: all 0.6s ease;
        }

        .back-button:hover::after {
            left: 100%;
        }

        .product-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 74.8vh;
        }

        @keyframes popIn {
            0% {
                transform: scale(1);
            }

            60% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }


        /* 🔹 Card principale */
        .product-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: row;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            animation: fadeIn 0.7s ease forwards;
            transform-origin: top center;
            position: relative;
        }

        /* 🔹 Sezione immagine */
        .product-image {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-image:hover img {
            transform: scale(1.05);
        }

        /* 🔹 Frecce navigazione */
        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            padding: 12px 15px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .nav-arrow:hover {
            background: rgba(0, 0, 0, 0.85);
            transform: translateY(-50%) scale(1.1);
        }

        .nav-arrow.left {
            left: 15px;
        }

        .nav-arrow.right {
            right: 15px;
        }

        /* 🔹 Dettagli prodotto */
        .product-details {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .product-description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 25px;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: 600;
            color: #e63946;
            margin-bottom: 25px;
        }

        .btn-cart {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            transition: background 0.3s ease;
            align-self: start;
        }

        .btn-cart:hover {
            background-color: #0056b3;
        }

        /* 🔹 Pulsante "Torna ai prodotti" */
        .back-button {
            position: absolute;
            top: 45%;
            left: 2%;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 50px;
            padding: 12px 22px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow: hidden;
            opacity: 1;
            transform: translateX(-30px);
            animation: slideInLeft 0.6s ease forwards 0.4s;
            animation: popIn 1.5s ease-in-out infinite;
        }

        .back-button i {
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .back-button:hover i {
            transform: translateX(-5px);
        }

        /* Effetto luce */
        .back-button::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, 0.5) 50%, transparent 100%);
            transition: all 0.6s ease;
        }

        .back-button:hover::after {
            left: 100%;
        }

        /* 🔹 Animazioni */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
            }

            .product-details {
                padding: 20px;
            }

            .back-button {
                top: 20px;
                left: 20px;
                font-size: 14px;
                padding: 10px 16px;
            }
        }

        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="birthstone-regular d-flex flex-column min-vh-100">

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
                            <button
                                class="inline-flex w-full justify-center gap-x-1.5 rounded-md px-3 text-sm font-semibold text-gray-900 shadow-xs">
                                @if (!Auth::user()->imageprofile)
                                    <div class="avatar-circle" id="circleImage"><i class="fa-solid fa-user fa-lg"
                                            style="color: #c3c6d1;"></i></div>
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->imageprofile) }}" alt="Avatar"
                                        class="w-12 h-12 rounded-full object-cover">
                                @endif
                            </button>

                            <el-menu anchor="bottom end" popover
                                class="w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                <div class="py-1">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Dati
                                        Anagrafici</a>
                                    @if (!Auth::user()->imageprofile)
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden"
                                            data-bs-toggle="modal" data-bs-target="#uploadModal"> Aggiungi immagine</a>
                                    @else
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden"
                                            data-bs-toggle="modal" data-bs-target="#uploadModal"> Cambia immagine</a>
                                    @endif
                                    <a href="{{route('page.cart')}}"
                                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">Carrello</a>
                                    <form action="{{ route('logoutUser') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-left text-sm text-red-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Chiudi"></button>
                </div>

                <div class="modal-body text-center">
                    <form action="{{ route('uploadAvatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Immagine di anteprima -->
                        <div class="mb-3 hidden" id="containerAnteprima">
                            <img id="previewImage" src="" alt="Anteprima immagine" class="shadow-sm"
                                style="width: 120px; height: 120px; object-fit: cover; margin-bottom: 15px; margin: 0 auto;">
                        </div>

                        <!-- Input file -->
                        <div class="mb-3">
                            <input type="file" class="form-control" id="avatarInput" name="imageProfile"
                                accept="image/*" required>
                        </div>

                        <button type="submit" class="btn w-100 text-white"
                            style="background-color:#B3543E; border:none;">
                            Carica immagine
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma eliminazione</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Chiudi"></button>
                </div>

                <div class="modal-body text-center">
                    <p>Sei sicuro di voler eliminare questi elementi dal carrello?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Elimina</button>
                </div>
            </div>
        </div>
    </div>


    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-100 bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">© {{ date('Y') }} Salumeria Bella Vita - Tutti i diritti riservati</p>
    </footer>
    <script>
        //Qui gestisco l'immagine di profilo
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('avatarInput');
            const preview = document.getElementById('previewImage');

            input.addEventListener('change', function (e) {
                document.getElementById('containerAnteprima').classList.remove('hidden');
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        //Qui implemento il mostra/nascondi la password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const icon = document.getElementById('toggleIcon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordConfirmationInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                passwordConfirmationInput.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        //Dopo due secondi gli alert spariscono
        setTimeout(() => {
            document.getElementById('confirmation').style.display = 'none';
        }, 2000);

        let formToSubmit = null;

        function openConfirmModal(button) {
            // Salva il riferimento al form originale
            formToSubmit = button.closest('form');
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            modal.show();
        }

        function scaleButton(event) {
            const btn = event.target; // Prende il bottone cliccato

            // 1. Applica la classe per rimpicciolire
            btn.style.transform = "scale(0.9)";
            // 2. Dopo 100ms (durata del click), rimuove la classe per farlo tornare normale
            setTimeout(() => {
                btn.style.transform = "scale(1)";
            }, 100);
        }

        // Quando clicchi "Elimina" nella modale → invia il form salvato
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });


        //In base ai primi numeri inseriti nel campo 'Numero carta' esce un diverso tipo di carta
        document.getElementById('card_number').addEventListener('input', function () {
            const value = this.value.replace(/\s+/g, ''); // rimuove spazi
            const first4 = value.substring(0, 4);

            const visa_logo = document.getElementById('visa_logo');
            const mastercard_logo = document.getElementById('mastercard_logo');
            const discover_logo = document.getElementById('discover_logo');

            if (first4.length === 4 && !isNaN(first4)) {
                const num = parseInt(first4);

                if (num >= 1000 && num <= 2000) {
                    visa_logo.style.display = 'block';
                } else if (num >= 2001 && num <= 3000) {
                    mastercard_logo.style.display = 'block';
                } else if (num >= 3001 && num <= 4000) {
                    discover_logo.style.display = 'block';
                }
            } else {
                visa_logo.style.display = 'none';
                mastercard_logo.style.display = 'none';
                discover_logo.style.display = 'none';
            }
        });

        //qui quando clicco la checkbox invia il form
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form');
            document.getElementById('checkbox').addEventListener('change', function () {
                form.submit();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
