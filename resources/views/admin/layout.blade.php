<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Furder</title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .sidebar-link:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #4f46e5;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Project action buttons hover fix */
        .action-btn {
            color: #6b7280;
            transition: color 0.2s ease;
        }
        .action-btn:hover.view-btn {
            color: #3b82f6;
        }
        .action-btn:hover.edit-btn {
            color: #f59e0b;
        }
        .action-btn:hover.delete-btn {
            color: #ef4444;
        }
        .action-btn:hover.external-btn {
            color: #10b981;
        }
        .action-btn:hover.github-btn {
            color: #374151;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <div class="flex items-center">
                    <img src="{{ asset('images/furderlogofooter.png') }}" alt="Furder Logo" class="h-8 w-auto mr-3" />
                    <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
                </div>
            </div>
            
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.projects.index') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <i class="fas fa-folder mr-3"></i>
                        Projeler
                    </a>
                    
                    <a href="{{ route('admin.contact-messages.index') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope mr-3"></i>
                        İletişim Mesajları
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="px-4 mt-8">
                    <div class="border-t pt-4">
                        <a href="{{ url('/') }}" target="_blank" 
                           class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-colors duration-200">
                            <i class="fas fa-external-link-alt mr-3"></i>
                            Siteyi Görüntüle
                        </a>
                        
                        <form method="POST" action="{{ route('admin.logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" 
                                    class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-colors duration-200 w-full text-left">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Çıkış Yap
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-gray-600 text-sm">@yield('page-description', 'Admin panel yönetim sayfası')</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
