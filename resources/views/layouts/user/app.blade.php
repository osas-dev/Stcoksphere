<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stock Sphere') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <link rel="stylesheet" href="{{asset('./assets/css/tailwind.output.css')}}" />
    <script src="{{asset('./assets/js/init-alpine.js')}}"></script>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="{{asset('./assets/js/charts-lines.js')}}" defer></script>
    <script src="{{asset('./assets/js/charts-pie.js')}}" defer></script>
    <style>
        .preloader {
            --uib-size: 45px;
            --uib-color: black;
            --uib-speed: 1.75s;
            display: flex;
            align-items: flex-end;
            padding-bottom: 20%;
            justify-content: space-between;
            width: var(--uib-size);
            height: calc(var(--uib-size) * 0.6);
        }

        .cube {
            flex-shrink: 0;
            width: calc(var(--uib-size) * 0.2);
            height: calc(var(--uib-size) * 0.2);
            animation: jump var(--uib-speed) ease-in-out infinite;
        }

        .cube__inner {
            display: block;
            height: 100%;
            width: 100%;
            border-radius: 25%;
            background-color: var(--uib-color);
            transform-origin: center bottom;
            animation: morph var(--uib-speed) ease-in-out infinite;
            transition: background-color 0.3s ease;
        }

        .cube:nth-child(2) {
            animation-delay: calc(var(--uib-speed) * -0.36);

            .cube__inner {
                animation-delay: calc(var(--uib-speed) * -0.36);
            }
        }

        .cube:nth-child(3) {
            animation-delay: calc(var(--uib-speed) * -0.2);

            .cube__inner {
                animation-delay: calc(var(--uib-speed) * -0.2);
            }
        }

        @keyframes jump {
            0% {
                transform: translateY(0px);
            }

            30% {
                transform: translateY(0px);
                animation-timing-function: ease-out;
            }

            50% {
                transform: translateY(-200%);
                animation-timing-function: ease-in;
            }

            75% {
                transform: translateY(0px);
                animation-timing-function: ease-in;
            }
        }

        @keyframes morph {
            0% {
                transform: scaleY(1);
            }

            10% {
                transform: scaleY(1);
            }

            20%,
            25% {
                transform: scaleY(0.6) scaleX(1.3);
                animation-timing-function: ease-in-out;
            }

            30% {
                transform: scaleY(1.15) scaleX(0.9);
                animation-timing-function: ease-in-out;
            }

            40% {
                transform: scaleY(1);
            }

            70%,
            85%,
            100% {
                transform: scaleY(1);
            }

            75% {
                transform: scaleY(0.8) scaleX(1.2);
            }
        }

        body.loading {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div id="preloader"
        style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; position: absolute; top: 0; z-index: 5; background: white; overflow: hidden;">
        <div>
            <div class="preloader">
                <div class="cube">
                    <div class="cube__inner"></div>
                </div>
                <div class="cube">
                    <div class="cube__inner"></div>
                </div>
                <div class="cube">
                    <div class="cube__inner"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-sidebar></x-sidebar>
        <div class="flex flex-col flex-1 w-full">

            @include('layouts.user.navigation')



            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <!-- Page Heading -->
                    @isset($header)
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            {{$header}}
                        </h2>
                    @endisset
                    
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @include('sweetalert::alert')

    <script>
        // Add this when preloader starts
        document.body.classList.add('loading');

        // Remove this when preloader ends
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
            document.body.classList.remove('loading');
        });
    </script>
</body>

</html>
