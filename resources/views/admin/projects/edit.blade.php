@extends('admin.layout')

@section('title', 'Proje Düzenle')
@section('page-title', 'Proje Düzenle')
@section('page-description', $project->title . ' projesini düzenleyin')

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Temel Bilgiler</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Proje Başlığı *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $project->title) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                        Alt Başlık
                    </label>
                    <input type="text" 
                           id="subtitle" 
                           name="subtitle" 
                           value="{{ old('subtitle', $project->subtitle) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('subtitle')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category & Client -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori *
                        </label>
                        <select id="category" 
                                name="category" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Kategori seçin</option>
                            <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>Web Uygulaması</option>
                            <option value="mobile" {{ old('category', $project->category) == 'mobile' ? 'selected' : '' }}>Mobil Uygulama</option>
                            <option value="desktop" {{ old('category', $project->category) == 'desktop' ? 'selected' : '' }}>Desktop Uygulama</option>
                            <option value="ecommerce" {{ old('category', $project->category) == 'ecommerce' ? 'selected' : '' }}>E-Ticaret</option>
                            <option value="crm" {{ old('category', $project->category) == 'crm' ? 'selected' : '' }}>CRM Sistemi</option>
                            <option value="erp" {{ old('category', $project->category) == 'erp' ? 'selected' : '' }}>ERP Sistemi</option>
                            <option value="api" {{ old('category', $project->category) == 'api' ? 'selected' : '' }}>API Geliştirme</option>
                        </select>
                        @error('category')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="client" class="block text-sm font-medium text-gray-700 mb-2">
                            Müşteri/Şirket
                        </label>
                        <input type="text" 
                               id="client" 
                               name="client" 
                               value="{{ old('client', $project->client) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('client')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Kısa Açıklama *
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Detailed Description -->
                <div>
                    <label for="detailed_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Detaylı Açıklama
                    </label>
                    <textarea id="detailed_description" 
                              name="detailed_description" 
                              rows="5"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('detailed_description', $project->detailed_description) }}</textarea>
                    @error('detailed_description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Technologies -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Teknolojiler</h3>
            </div>
            <div class="p-6">
                <div>
                    <label for="technologies" class="block text-sm font-medium text-gray-700 mb-2">
                        Kullanılan Teknolojiler *
                    </label>
                    <div id="technologies-container" class="space-y-2">
                        @php
                            $oldTechnologies = old('technologies', $project->technologies ?? []);
                            if (is_string($oldTechnologies)) {
                                $oldTechnologies = json_decode($oldTechnologies, true) ?? [];
                            }
                        @endphp
                        @foreach($oldTechnologies as $tech)
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       name="technologies[]" 
                                       value="{{ $tech }}"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" 
                                        onclick="this.parentElement.remove()" 
                                        class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        @endforeach
                        @if(empty($oldTechnologies))
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       name="technologies[]" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" 
                                        onclick="addTechnology()" 
                                        class="px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" 
                            onclick="addTechnology()" 
                            class="mt-2 px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Teknoloji Ekle
                    </button>
                    @error('technologies')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Links & Media -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Linkler ve Medya</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- URLs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="project_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Proje URL'si
                        </label>
                        <input type="url" 
                               id="project_url" 
                               name="project_url" 
                               value="{{ old('project_url', $project->project_url) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('project_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="github_url" class="block text-sm font-medium text-gray-700 mb-2">
                            GitHub URL'si
                        </label>
                        <input type="url" 
                               id="github_url" 
                               name="github_url" 
                               value="{{ old('github_url', $project->github_url) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('github_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Image -->
                @if($project->image_path)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Mevcut Ana Görsel
                        </label>
                        <img src="{{ Storage::url($project->image_path) }}" 
                             alt="{{ $project->title }}" 
                             class="w-32 h-32 object-cover rounded-lg">
                    </div>
                @endif

                <!-- Main Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $project->image_path ? 'Yeni Ana Görsel' : 'Ana Görsel' }}
                    </label>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">JPG, PNG, GIF formatları desteklenir. Maksimum 2MB.</p>
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gallery -->
                <div>
                    <label for="gallery" class="block text-sm font-medium text-gray-700 mb-2">
                        Galeri Görselleri
                    </label>
                    <input type="file" 
                           id="gallery" 
                           name="gallery[]" 
                           multiple
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Yeni görseller mevcut galeriyi değiştirecektir.</p>
                    @error('gallery.*')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Project Details -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Proje Detayları</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Duration -->
                    <div>
                        <label for="duration_days" class="block text-sm font-medium text-gray-700 mb-2">
                            Süre (Gün)
                        </label>
                        <input type="number" 
                               id="duration_days" 
                               name="duration_days" 
                               value="{{ old('duration_days', $project->duration_days) }}"
                               min="1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('duration_days')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Completed Date -->
                    <div>
                        <label for="completed_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Tamamlanma Tarihi
                        </label>
                        <input type="date" 
                               id="completed_at" 
                               name="completed_at" 
                               value="{{ old('completed_at', $project->completed_at?->format('Y-m-d')) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('completed_at')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Durum *
                        </label>
                        <select id="status" 
                                name="status" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                            <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>Devam Ediyor</option>
                            <option value="paused" {{ old('status', $project->status) == 'paused' ? 'selected' : '' }}>Durduruldu</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Options -->
                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               value="1"
                               {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Öne çıkan proje</span>
                    </label>
                </div>

                <!-- Sort Order -->
                <div class="w-32">
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                        Sıralama
                    </label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           value="{{ old('sort_order', $project->sort_order) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('sort_order')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.projects.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                İptal
            </a>
            <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-save mr-2"></i>
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>

<script>
function addTechnology() {
    const container = document.getElementById('technologies-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" 
               name="technologies[]" 
               class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
               placeholder="Teknoloji adı">
        <button type="button" 
                onclick="this.parentElement.remove()" 
                class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}
</script>
@endsection
