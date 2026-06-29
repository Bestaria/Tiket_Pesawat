<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Air Ticket - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            padding: 8px 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.25);
            border-bottom: 3px solid #10b981;
        }

        .navbar-custom .container {
            max-width: 1100px;
            padding: 0 16px;
        }

        .navbar-custom .navbar-brand {
            color: white;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: 0.5px;
            padding: 0;
        }

        .navbar-custom .navbar-brand span {
            color: #10b981;
        }

        .navbar-custom .navbar-brand i {
            color: #10b981;
            margin-right: 5px;
            font-size: 16px;
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.7) !important;
            font-weight: 600;
            padding: 5px 14px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .navbar-custom .nav-link:hover {
            color: white !important;
            background: rgba(16, 185, 129, 0.2);
        }

        .navbar-custom .nav-link.active {
            color: white !important;
            background: rgba(16, 185, 129, 0.3);
        }

        .navbar-custom .nav-link i {
            margin-right: 4px;
            font-size: 13px;
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171 !important;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 5px 16px !important;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.3);
            color: white !important;
            border-color: #ef4444;
        }

        .btn-logout i {
            font-size: 13px;
        }

        /* ===== NAVBAR MENU KE KANAN ===== */
        .navbar-collapse {
            justify-content: flex-end;
        }

        .navbar-nav {
            gap: 2px;
            align-items: center;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .navbar-custom .container {
                max-width: 100%;
                padding: 0 14px;
            }
            .navbar-collapse {
                justify-content: flex-start;
                margin-top: 6px;
            }
            .navbar-nav {
                width: 100%;
                gap: 2px;
            }
            .nav-item {
                width: 100%;
            }
            .nav-link {
                padding: 6px 12px !important;
            }
            .btn-logout {
                width: 100%;
                justify-content: center;
                margin-top: 3px;
            }
        }

        /* ===== MAIN CONTENT ===== */
        main {
            padding: 20px 0 40px;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <!-- LOGO DI KIRI -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-plane"></i> Air <span>Ticket</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" 
                style="border-color: rgba(255,255,255,0.3);">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <!-- MENU DI KANAN -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('airlines.*') ? 'active' : '' }}" 
                           href="{{ route('airlines.index') }}">
                            <i class="fas fa-building"></i> Maskapai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('flights.*') ? 'active' : '' }}" 
                           href="{{ route('flights.index') }}">
                            <i class="fas fa-plane-departure"></i> Penerbangan
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>