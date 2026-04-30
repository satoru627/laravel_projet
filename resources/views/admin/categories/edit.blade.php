@extends('layouts.app')

@section('title', 'Modifier la Catégorie')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" 
               class="text-primary-600 hover:text-primary-700 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Modifier la Catégorie</h1>
        
        {{-- ✅ enctype ajouté --}}
        <form action="{{ route('admin.categories.update', $categorie->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md p-8">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nom de la catégorie <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           id="nom" 
                           name="nom" 
                           value="{{ old('nom') }}"
                           placeholder="Ex: Électronique"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nom') border-red-500 @enderror">
                    @error('nom')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div> {{-- ✅ </div> ajouté --}}
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Décrivez brièvement cette catégorie</p>
                </div>
                
                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        image
                    </label>

                    <div id="dropZone"
                         onclick="document.getElementById('image').click()" {{-- ✅ corrigé --}}
                         class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center cursor-pointer hover:bg-gray-50 transition-colors">
                        <svg class="mx-auto mb-2 text-gray-300 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm font-medium text-gray-600">Cliquer ou déposer une image</p>
                        <p class="text-xs text-gray-400 mt-1">JPEG, PNG, WEBP — max 2 Mo</p>
                    </div>

                    <input type="file"
                           id="image" {{-- ✅ corrigé --}}
                           name="image" {{-- ✅ corrigé --}}
                           accept="image/jpeg,image/png,image/webp"
                           class="hidden"
                           onchange="previewImage(event)">

                    @error('image') {{-- ✅ corrigé --}}
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <div id="image_preview" class="mt-3">
                        @if(isset($categorie) && $categorie->image) {{-- ✅ corrigé --}}
                            <img src="{{ Storage::url($categorie->image) }}"
                                 alt="Image actuelle"
                                 class="max-h-40 rounded-xl border border-gray-100 object-cover">
                        @endif
                    </div>
                </div>
                
                <br><br>
                <!-- Statut actif -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="actif" 
                           name="actif" 
                           checked
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="actif" class="ml-2 block text-sm font-semibold text-gray-700">
                        Catégorie active
                    </label>
                </div><br>
                <p class="text-xs text-gray-500 -mt-4 ml-6">
                    Les catégories inactives ne seront pas visibles sur le site
                </p>
            </div>
            
            <!-- Boutons -->
            <div class="mt-8 flex space-x-4">
                <button type="submit" 
                        class="bg-primary-600 text-white px-8 py-3 rounded-lg hover:bg-primary-700 transition font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    Modifier
                </button>
                <a href="{{ route('admin.categories.index') }}" 
                   class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition font-semibold">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

{{-- ✅ fonction previewImage ajoutée --}}
@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('image_preview');
            preview.innerHTML = `<img src="${e.target.result}" class="max-h-40 rounded-xl border border-gray-100 object-cover" alt="Aperçu">`;
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
@endsection