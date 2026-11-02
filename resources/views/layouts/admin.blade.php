<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name', 'LuxuryEstate') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
            width: 250px;
            transition: all 0.3s;
        }
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #374151;
        }
        .sidebar-menu {
            padding: 20px 0;
        }
        .sidebar-menu a {
            display: block;
            padding: 12px 20px;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover {
            color: #fbbf24;
            background-color: rgba(251, 191, 36, 0.1);
        }
        .sidebar-menu a.active {
            color: #fbbf24;
            background-color: rgba(251, 191, 36, 0.1);
            border-left: 3px solid #fbbf24;
        }
        .sidebar-menu i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .navbar-admin {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2 class="text-white font-bold text-xl">
                    <i class="fas fa-crown text-yellow-500"></i> Admin Panel
                </h2>
                <p class="text-gray-400 text-sm mt-2">LuxuryEstate</p>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Manage Users
                </a>
                <a href="#">
                    <i class="fas fa-home"></i> Properties
                </a>
                <a href="#">
                    <i class="fas fa-list"></i> Categories
                </a>
                <a href="#">
                    <i class="fas fa-envelope"></i> Inquiries
                </a>
                <hr class="border-gray-700 my-4">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-arrow-left"></i> Back to Site
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Navbar -->
            <nav class="navbar-admin mb-4">
                <div class="container-fluid d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0">@yield('title', 'Dashboard')</h4>
                    <div class="d-flex align-items-center">
                        <span class="text-gray-600 mr-3">
                            <i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                        </span>
                        <span class="badge bg-yellow-500 text-black px-3 py-1 rounded-full">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>
            </nav>
            
            <!-- Content -->
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>