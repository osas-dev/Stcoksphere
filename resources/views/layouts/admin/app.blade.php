<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Sphere Admin</title>
    <meta name="author" content="Stock Sphere">
    <meta name="description" content="">

    <!-- Tailwind -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

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
        
        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">
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

    @include('layouts.admin.includes.sidebar')


    <div class="w-full flex flex-col h-screen overflow-y-hidden">

        @include('layouts.admin.includes.header')

        <div class="w-full overflow-x-hidden border-t flex flex-col">

            @yield('content')

            @include('layouts.admin.includes.footer')
        </div>

    </div>
    @include('sweetalert::alert')

    <!-- AlpineJS -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        function confirmDelete(event, formId) {
            event.preventDefault(); // Prevent form submission until confirmed
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the specific form
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
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
