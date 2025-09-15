@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Genel istatistikler ve son aktiviteler')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Projects -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-project-diagram text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Toplam Proje</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_projects'] }}</p>
            </div>
        </div>
    </div>

    <!-- Featured Projects -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-star text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Öne Çıkan</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['featured_projects'] }}</p>
            </div>
        </div>
    </div>

    <!-- Total Messages -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-envelope text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Toplam Mesaj</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_messages'] }}</p>
            </div>
        </div>
    </div>

    <!-- Unread Messages -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-bell text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Okunmamış</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['unread_messages'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Messages -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Son Mesajlar</h3>
                <a href="{{ route('admin.contact-messages.index') }}" 
                   class="text-sm text-blue-600 hover:text-blue-800">Tümünü Gör</a>
            </div>
        </div>
        <div class="p-6">
            @forelse($recent_messages as $message)
                <div class="flex items-start space-x-3 {{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-semibold">{{ substr($message->full_name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">{{ $message->full_name }}</p>
                            <div class="flex items-center space-x-2">
                                @if(!$message->is_read)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yeni
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">{{ $message->project_type_display }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ Str::limit($message->project_details, 60) }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Henüz mesaj bulunmuyor</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Son Projeler</h3>
                <a href="{{ route('admin.projects.index') }}" 
                   class="text-sm text-blue-600 hover:text-blue-800">Tümünü Gör</a>
            </div>
        </div>
        <div class="p-6">
            @forelse($recent_projects as $project)
                <div class="flex items-start space-x-3 {{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                    <div class="flex-shrink-0">
                        @if($project->image_path)
                            <img src="{{ Storage::url($project->image_path) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-project-diagram text-white"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">{{ $project->title }}</p>
                            <div class="flex items-center space-x-2">
                                @if($project->is_featured)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-star mr-1"></i> Öne Çıkan
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $project->status_badge }}-100 text-{{ $project->status_badge }}-800">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                        </div>
                        @if($project->subtitle)
                            <p class="text-sm text-gray-600">{{ $project->subtitle }}</p>
                        @endif
                        <p class="text-sm text-gray-500">{{ $project->category }} • {{ $project->technologies_list }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-plus-circle text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 mb-4">Henüz proje bulunmuyor</p>
                    <a href="{{ route('admin.projects.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        İlk Projeyi Ekle
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Hızlı İşlemler</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.projects.create') }}" 
           class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-900">Yeni Proje</h4>
                    <p class="text-sm text-gray-500">Portföye proje ekle</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.contact-messages.index') }}" 
           class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-900">Mesajları Kontrol Et</h4>
                    <p class="text-sm text-gray-500">Gelen talepleri incele</p>
                </div>
            </div>
        </a>

        <a href="{{ url('/') }}" target="_blank"
           class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-external-link-alt text-xl"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-900">Siteyi Görüntüle</h4>
                    <p class="text-sm text-gray-500">Ana siteyi kontrol et</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
