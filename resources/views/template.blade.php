<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>


    <!-- Leaflet CSS-->
    <link rel="icon" href="https://i.ibb.co.com/BCLJxwR/logo-gamacare.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>

    @yield('styles')

    <style>
        body {
            background-color: #2B4162;
            color: #ffffff;
        }
        .navbar {
            background-color: #F5B841;
        }
        .nav-link {
            color: #000000;
        }
        .nav-link:hover {
            color: #2B4162;
            background-color: #F5B841;
        }
        .modal-content {
            background-color: #2B4162;
            color: #ffffff;
        }
        .modal-header {
            border-bottom: 1px solid #F5B841;
        }
        .modal-title {
            color: #2B4162;
        }
        .modal-body {
            border-bottom: 1px solid #F5B841;
        }
        .btn-secondary {
            background-color: #F5B841;
            border-color: #F5B841;
        }
        .btn-secondary:hover {
            background-color: #E0A529;
            border-color: #E0A529;
        }
        .logo-img {
            height: 30px; /* Adjust the height as needed */
            /* Optionally, you can set a width to maintain aspect ratio */
            /* width: auto; */
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo-gamacare.ico') }}" alt="Logo" class="logo-img">
                {{$title}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route ('index') }}"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('table-point') }}" ><i class="fa-solid fa-notes-medical"></i> Data Lokasi Fasilitas </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fa-solid fa-circle-info"></i> Info</a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="nav-item">
                            <button class="nav-link text-danger" type="submit"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
                        </li>
                    </form>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route ('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">About</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Nama  : Laila Nur Azizah</p>
                    <p>NIM   : 22/500377/SV/21411</p>
                    <p>Kelas : B</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.toast')

    @yield('script')

</body>
</html>
