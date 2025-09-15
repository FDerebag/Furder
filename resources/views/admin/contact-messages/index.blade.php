@extends('admin.layout')

@section('title', 'İletişim Mesajları')
@section('page-title', 'İletişim Mesajları')
@section('page-description', 'Gelen teklif taleplerini yönetin')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Tüm Mesajlar ({{ $messages->total() }})</h3>
            <p class="text-sm text-gray-600">
                {{ $messages->where('is_read', false)->count() }} okunmamış mesaj
            </p>
        </div>
        
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Filtrele:</span>
            <a href="{{ route('admin.contact-messages.index') }}" 
               class="px-3 py-1 text-sm rounded-md {{ !request('filter') ? 'bg-blue-100 text-blue-800' : 'text-gray-600 hover:bg-gray-100' }}">
                Tümü
            </a>
            <a href="{{ route('admin.contact-messages.index', ['filter' => 'unread']) }}" 
               class="px-3 py-1 text-sm rounded-md {{ request('filter') == 'unread' ? 'bg-red-100 text-red-800' : 'text-gray-600 hover:bg-gray-100' }}">
                Okunmamış
            </a>
            <a href="{{ route('admin.contact-messages.index', ['filter' => 'read']) }}" 
               class="px-3 py-1 text-sm rounded-md {{ request('filter') == 'read' ? 'bg-green-100 text-green-800' : 'text-gray-600 hover:bg-gray-100' }}">
                Okunmuş
            </a>
        </div>
    </div>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-md">
    @forelse($messages as $message)
        <div class="border-b border-gray-200 last:border-b-0 {{ !$message->is_read ? 'bg-blue-50' : '' }}">
            <div class="px-6 py-4">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">{{ substr($message->full_name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $message->full_name }}</h4>
                                    @if(!$message->is_read)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Yeni
                                        </span>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-3">
                                <div>
                                    <i class="fas fa-envelope mr-1"></i>
                                    {{ $message->email }}
                                </div>
                                <div>
                                    <i class="fas fa-phone mr-1"></i>
                                    {{ $message->phone }}
                                </div>
                                @if($message->company)
                                    <div>
                                        <i class="fas fa-building mr-1"></i>
                                        {{ $message->company }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm mb-3">
                                <div>
                                    <span class="font-medium text-gray-700">Proje Türü:</span>
                                    <span class="ml-1 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                        {{ $message->project_type_display }}
                                    </span>
                                </div>
                                
                                @if($message->budget)
                                    <div>
                                        <span class="font-medium text-gray-700">Bütçe:</span>
                                        <span class="ml-1 text-gray-600">{{ $message->budget_display }}</span>
                                    </div>
                                @endif
                                
                                @if($message->timeline)
                                    <div>
                                        <span class="font-medium text-gray-700">Zaman:</span>
                                        <span class="ml-1 text-gray-600">{{ $message->timeline_display }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <p class="text-gray-700 text-sm leading-relaxed mb-3">
                                {{ Str::limit($message->project_details, 200) }}
                            </p>
                            
                            @if($message->notes)
                                <div class="bg-yellow-50 border border-yellow-200 rounded p-3 mb-3">
                                    <div class="flex items-center mb-1">
                                        <i class="fas fa-sticky-note text-yellow-600 mr-2"></i>
                                        <span class="text-sm font-medium text-yellow-800">Admin Notları</span>
                                    </div>
                                    <p class="text-sm text-yellow-700">{{ $message->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 ml-4">
                        @if(!$message->is_read)
                            <form method="POST" action="{{ route('admin.contact-messages.mark-as-read', $message) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="action-btn p-2 rounded-lg hover:bg-green-50 hover:text-green-600"
                                        title="Okundu İşaretle">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.contact-messages.mark-as-unread', $message) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="action-btn p-2 rounded-lg hover:bg-yellow-50 hover:text-yellow-600"
                                        title="Okunmadı İşaretle">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('admin.contact-messages.show', $message) }}" 
                           class="action-btn p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600"
                           title="Detayları Gör">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        <a href="mailto:{{ $message->email }}" 
                           class="action-btn p-2 rounded-lg hover:bg-green-50 hover:text-green-600"
                           title="E-posta Gönder">
                            <i class="fas fa-reply"></i>
                        </a>
                        
                        <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" 
                              class="inline"
                              onsubmit="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="action-btn p-2 rounded-lg hover:bg-red-50 hover:text-red-600"
                                    title="Sil">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Henüz mesaj bulunmuyor</h3>
            <p class="text-gray-500">Müşteriler iletişim formunu kullandığında mesajlar burada görünecek.</p>
        </div>
    @endforelse
</div>

@if($messages->hasPages())
    <div class="mt-6">
        {{ $messages->appends(request()->query())->links() }}
    </div>
@endif
@endsection
