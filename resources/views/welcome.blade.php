<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel | GW</title>

    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Instrument Sans', sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 600;
            color: #0d6efd !important;
        }

        .nav-link {
            color: #555 !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #0d6efd !important;
        }

        .banner {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
                url('https://plus.unsplash.com/premium_photo-1682089297123-85459da8036b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fGhvdGVsfGVufDB8fDB8fHww') center center/cover no-repeat;
            height: 450px;
            color: white;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .section-title {
            color: #0d6efd;
            font-weight: 600;
        }

        .card {
            border: 1px solid #e0e0e0;
            transition: transform 0.2s ease-in-out;
            border-radius: 12px;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-title {
            font-weight: 600;
        }

        .card-text {
            color: #666;
        }

        .footer {
            background-color: #f8f9fa;
            color: #888;
            padding: 15px 0;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">Hotel App | GW</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner d-flex align-items-center justify-content-center text-white">
        <div class="text-center">
            <h1 class="display-4 fw-bold">Welcome to Hotel App GW</h1>
            <p class="lead">A luxurious stay awaits you</p>
            <a href="/bedrooms" class="btn btn-primary btn-lg mt-3">Book Now</a>
        </div>
    </div>

    <!-- Rooms Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4 section-title">Our Rooms</h2>
        <div class="row">
            @foreach ([['title' => 'Deluxe Room', 'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c', 'desc' => 'Enjoy your stay in our comfortable deluxe room.'], ['title' => 'Executive Suite', 'img' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGhvdGVsfGVufDB8fDB8fHww', 'desc' => 'Experience the luxury of our executive suite.'], ['title' => 'Presidential Suite', 'img' => 'https://images.unsplash.com/photo-1444201983204-c43cbd584d93?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fGhvdGVsfGVufDB8fDB8fHww', 'desc' => 'Indulge in the elegance of our presidential suite.']] as $room)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ $room['img'] }}" class="card-img-top" alt="{{ $room['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $room['title'] }}</h5>
                            <p class="card-text">{{ $room['desc'] }}</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Services Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4 section-title">Our Services</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-headset text-primary fs-1"></i>
                </div>
                <h5 class="text-primary">24/7 Customer Service</h5>
                <p>We are available round the clock to serve you.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-wifi text-primary fs-1"></i>
                </div>
                <h5 class="text-primary">Free Wifi</h5>
                <p>Stay connected with our complimentary high-speed internet.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-flower3 text-primary fs-1"></i>
                </div>
                <h5 class="text-primary">Spa and Wellness</h5>
                <p>Relax and rejuvenate with our spa services.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Hotel App GW. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
