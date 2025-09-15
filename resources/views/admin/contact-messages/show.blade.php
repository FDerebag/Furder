@extends('admin.layout')

@section('title', 'Mesaj Detayı')
@section('page-title', $contactMessage->full_name . ' - Mesaj Detayı')
@section('page-description', 'İletişim mesajı detayları ve admin notları')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Actions -->
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.contact-messages.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i>
            Mesajlara Dön
        </a>
        
        <div class="flex items-center space-x-2">
            @if(!$contactMessage->is_read)
                <form method="POST" action="{{ route('admin.contact-messages.mark-as-read', $contactMessage) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <i class="fas fa-check mr-2"></i>
                        Okundu İşaretle
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.contact-messages.mark-as-unread', $contactMessage) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-undo mr-2"></i>
                        Okunmadı İşaretle
                    </button>
                </form>
            @endif
            
            <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->project_type_display }} Talebi" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-reply mr-2"></i>
                E-posta Gönder
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Message Details -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 {{ !$contactMessage->is_read ? 'bg-blue-50' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-lg font-semibold">{{ substr($contactMessage->full_name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold text-gray-900">{{ $contactMessage->full_name }}</h1>
                                <p class="text-sm text-gray-600">{{ $contactMessage->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if(!$contactMessage->is_read)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Yeni Mesaj
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>
                                Okundu
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Contact Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">E-posta</dt>
                            <dd class="mt-1">
                                <a href="mailto:{{ $contactMessage->email }}" 
                                   class="text-blue-600 hover:text-blue-800">
                                    {{ $contactMessage->email }}
                                </a>
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Telefon</dt>
                            <dd class="mt-1">
                                <a href="tel:{{ $contactMessage->phone }}" 
                                   class="text-blue-600 hover:text-blue-800">
                                    {{ $contactMessage->phone }}
                                </a>
                            </dd>
                        </div>
                        
                        @if($contactMessage->company)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Şirket</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $contactMessage->company }}</dd>
                            </div>
                        @endif
                    </div>

                    <!-- Project Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Proje Detayları</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Proje Türü</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $contactMessage->project_type_display }}
                                    </span>
                                </dd>
                            </div>
                            
                            @if($contactMessage->budget)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Bütçe</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $contactMessage->budget_display }}</dd>
                                </div>
                            @endif
                            
                            @if($contactMessage->timeline)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Zaman Çizelgesi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $contactMessage->timeline_display }}</dd>
                                </div>
                            @endif
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-2">Proje Açıklaması</dt>
                            <dd class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg">
                                {{ $contactMessage->project_details }}
                            </dd>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Zaman Çizelgesi</h3>
                        <div class="flow-root">
                            <ul class="-mb-8">
                                <li>
                                    <div class="relative pb-8">
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-envelope text-white text-sm"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Mesaj gönderildi</p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    {{ $contactMessage->created_at->format('d.m.Y H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                
                                @if($contactMessage->is_read)
                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                        <i class="fas fa-check text-white text-sm"></i>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Mesaj okundu</p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        {{ $contactMessage->read_at?->format('d.m.Y H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Notes -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Admin Notları</h3>
                </div>
                
                <form method="POST" action="{{ route('admin.contact-messages.update', $contactMessage) }}" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notlar
                        </label>
                        <textarea id="notes" 
                                  name="notes" 
                                  rows="8"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Bu müşteri hakkında notlarınızı buraya yazabilirsiniz...">{{ old('notes', $contactMessage->notes) }}</textarea>
                        @error('notes')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        Notları Kaydet
                    </button>
                </form>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Hızlı İşlemler</h3>
                </div>
                
                <div class="p-6 space-y-3">
                    <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->project_type_display }} Talebi&body=Merhaba {{ $contactMessage->full_name }},%0D%0A%0D%0A{{ $contactMessage->project_type_display }} projeniz hakkında..." 
                       class="w-full inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-reply mr-2"></i>
                        E-posta Yanıtla
                    </a>
                    
                    <a href="tel:{{ $contactMessage->phone }}" 
                       class="w-full inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-phone mr-2"></i>
                        Telefon Et
                    </a>
                    
                    <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" 
                          onsubmit="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                            <i class="fas fa-trash mr-2"></i>
                            Mesajı Sil
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
