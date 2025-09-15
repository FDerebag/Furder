@extends('admin.layout')

@section('title', 'Projeler')
@section('page-title', 'Projeler')
@section('page-description', 'Portföy projelerini yönetin')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Tüm Projeler ({{ $projects->total() }})</h3>
        </div>
        <a href="{{ route('admin.projects.create') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-2"></i>
            Yeni Proje Ekle
        </a>
    </div>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-md">
    @forelse($projects as $project)
        <div class="border-b border-gray-200 last:border-b-0">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @if($project->image_path)
                            <img src="{{ Storage::url($project->image_path) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-16 h-16 rounded-lg object-cover">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-project-diagram text-white text-xl"></i>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h4 class="text-lg font-medium text-gray-900">{{ $project->title }}</h4>
                                @if($project->is_featured)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-star mr-1"></i> Öne Çıkan
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $project->status_badge }}-100 text-{{ $project->status_badge }}-800">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                            
                            @if($project->subtitle)
                                <p class="text-sm text-gray-600 mt-1">{{ $project->subtitle }}</p>
                            @endif
                            
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>
                            
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-tag mr-1"></i>{{ ucfirst($project->category) }}
                                </span>
                                @if($project->client)
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-user mr-1"></i>{{ $project->client }}
                                    </span>
                                @endif
                                @if($project->completed_at)
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>{{ $project->completed_at->format('d.m.Y') }}
                                    </span>
                                @endif
                            </div>
                            
                            <div class="flex flex-wrap gap-1 mt-2">
                                @php
                                    $technologies = is_array($project->technologies) ? $project->technologies : (json_decode($project->technologies, true) ?? []);
                                    $displayTechs = array_slice($technologies, 0, 4);
                                @endphp
                                @foreach($displayTechs as $tech)
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if(count($technologies) > 4)
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        +{{ count($technologies) - 4 }} daha
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank"
                               class="action-btn external-btn p-2 rounded-lg hover:bg-green-50"
                               title="Siteyi Ziyaret Et">
                                <i class="fas fa-external-link-alt text-lg"></i>
                            </a>
                        @endif
                        
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank"
                               class="action-btn github-btn p-2 rounded-lg hover:bg-gray-50"
                               title="GitHub">
                                <i class="fab fa-github text-lg"></i>
                            </a>
                        @endif
                        
                        <a href="{{ route('admin.projects.show', $project) }}" 
                           class="action-btn view-btn p-2 rounded-lg hover:bg-blue-50"
                           title="Detayları Gör">
                            <i class="fas fa-eye text-lg"></i>
                        </a>
                        
                        <a href="{{ route('admin.projects.edit', $project) }}" 
                           class="action-btn edit-btn p-2 rounded-lg hover:bg-yellow-50"
                           title="Düzenle">
                            <i class="fas fa-edit text-lg"></i>
                        </a>
                        
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" 
                              class="inline-block"
                              onsubmit="return confirm('Bu projeyi silmek istediğinizden emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="action-btn delete-btn p-2 rounded-lg hover:bg-red-50"
                                    title="Sil">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12">
            <i class="fas fa-project-diagram text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Henüz proje bulunmuyor</h3>
            <p class="text-gray-500 mb-6">İlk projenizi ekleyerek portföyünüzü oluşturmaya başlayın.</p>
            <a href="{{ route('admin.projects.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>
                İlk Projeyi Ekle
            </a>
        </div>
    @endforelse
</div>

@if($projects->hasPages())
    <div class="mt-6">
        {{ $projects->links() }}
    </div>
@endif
@endsection
