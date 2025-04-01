<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Iniciar sesion
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-center p-8 text-center">
        <h1 class="text-4xl font-bold">Bienvenido a CiverZone</h1>
            <p class="mt-4 text-lg">CiberZone: Donde la tecnología cobra vida</p>
    
            <section class="mt-6">
                <h2 class="text-2xl font-semibold">¿Quiénes Somos?</h2>
                <p class="mt-2">En CiberZone, somos apasionados por la tecnología y el entretenimiento digital. Nos especializamos en ofrecer productos de alta calidad para el mundo del cómputo, gaming, producción de video y tecnología en general. Nuestro objetivo es brindar a nuestros clientes las mejores herramientas para potenciar su experiencia digital, con productos innovadores y un servicio excepcional.</p>
            </section>
    
            <section class="mt-6">
                <h2 class="text-2xl font-semibold">Contáctanos</h2>
                <p class="mt-2">📍 Dirección: Sexta Pte. Nte. 1090-1180, Tuxtla GutierrezS</p>
                <p class="mt-2">📧 Correo electrónico:contactoCiverZ@empresa.com</p>
                <p>📞 Teléfono: +52 961 191 5387</p>
                <p>📱 Redes sociales: @CiverZoneOF</p>
            </section>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
