@extends('admin.layout')

@section('title', $project->title)
@section('page-title', $project->title)
@section('page-description', $project->subtitle ?: 'Proje detayları')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Actions -->
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.projects.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i>
            Projelere Dön
        </a>
        
        <div class="flex items-center space-x-2">
            @if($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Siteyi Ziyaret Et
                </a>
            @endif
            
            <a href="{{ route('admin.projects.edit', $project) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-edit mr-2"></i>
                Düzenle
            </a>
        </div>
    </div>

    <!-- Project Details -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if($project->image_path)
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ Storage::url($project->image_path) }}" 
                     alt="{{ $project->title }}" 
                     class="w-full h-64 object-cover">
            </div>
        @endif
        
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $project->title }}</h1>
                    @if($project->subtitle)
                        <p class="text-lg text-gray-600 mt-1">{{ $project->subtitle }}</p>
                    @endif
                </div>
                
                <div class="flex items-center space-x-2">
                    @if($project->is_featured)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i> Öne Çıkan
                        </span>
                    @endif
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $project->status_badge }}-100 text-{{ $project->status_badge }}-800">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>
            </div>

            <!-- Meta Info -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($project->category) }}</dd>
                </div>
                
                @if($project->client)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Müşteri</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $project->client }}</dd>
                    </div>
                @endif
                
                @if($project->duration_days)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Süre</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $project->duration_days }} gün</dd>
                    </div>
                @endif
                
                @if($project->completed_at)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tamamlanma</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $project->completed_at->format('d.m.Y') }}</dd>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Açıklama</h3>
                <p class="text-gray-700 leading-relaxed">{{ $project->description }}</p>
                
                @if($project->detailed_description)
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-sm font-medium text-blue-900 mb-2">Detaylı Açıklama</h4>
                        <p class="text-blue-800 text-sm leading-relaxed">{{ $project->detailed_description }}</p>
                    </div>
                @endif
            </div>

            <!-- Technologies -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Kullanılan Teknolojiler</h3>
                <div class="flex flex-wrap gap-2">
                    @php
                        $technologies = is_array($project->technologies) ? $project->technologies : (json_decode($project->technologies, true) ?? []);
                    @endphp
                    @foreach($technologies as $tech)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Links -->
            @if($project->project_url || $project->github_url)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Linkler</h3>
                    <div class="flex flex-wrap gap-4">
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Projeyi Ziyaret Et
                            </a>
                        @endif
                        
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fab fa-github mr-2"></i>
                                GitHub Repository
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Gallery -->
            @if($project->gallery && count($project->gallery) > 0)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Galeri</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($project->gallery as $image)
                            <img src="{{ Storage::url($image) }}" 
                                 alt="Gallery Image" 
                                 class="w-full h-32 object-cover rounded-lg">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
