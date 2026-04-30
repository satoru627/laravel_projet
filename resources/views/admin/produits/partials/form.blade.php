{{-- resources/views/admin/produits/_form.blade.php --}}
{{-- Composant partagé create + edit --}}

<div class="max-w-3xl mx-auto py-8 px-4">
    <form action="{{ $action }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">

        @csrf
        @if($method !== 'POST') @method($method) @endif

        {{-- En-tête --}}
        <h2 class="text-xl font-semibold text-gray-800 pb-4 border-b border-gray-100">
            {{ isset($produit) ? 'Modifier le produit' : 'Nouveau produit' }}
        </h2>

        {{-- Nom --}}
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-600 mb-1.5">
                Nom du produit
            </label>
            <input type="text"
                   id="nom"
                   name="nom"
                   value="{{ old('nom', $produit->nom ?? '') }}"
                   required
                   placeholder="Ex : Sac en cuir artisanal"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('nom') border-red-400 @enderror">
            @error('nom')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prix --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="prix" class="block text-sm font-medium text-gray-600 mb-1.5">Prix (FCFA)</label>
                <input type="number"
                       id="prix"
                       name="prix"
                       step="0.01"
                       min="0"
                       required
                       value="{{ old('prix', $produit->prix ?? 0) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('prix') border-red-400 @enderror">
                @error('prix')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="prix_promo" class="block text-sm font-medium text-gray-600 mb-1.5">
                    Prix promo <span class="font-normal text-gray-400">(optionnel)</span>
                </label>
                <input type="number"
                       id="prix_promo"
                       name="prix_promo"
                       step="0.01"
                       min="0"
                       value="{{ old('prix_promo', $produit->prix_promo ?? '') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
        </div>

        {{-- ✅ Upload image --}}
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1.5">
                Image principale
                @if(isset($produit)) <span class="font-normal text-gray-400">(laisser vide pour conserver)</span> @endif
            </label>

            {{-- Zone drag & drop --}}
            <div id="dropZone"
                 onclick="document.getElementById('image_principale').click()"
                 class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center cursor-pointer hover:bg-gray-50 transition-colors">
                <svg class="mx-auto mb-2 text-gray-300 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-medium text-gray-600">Cliquer ou déposer une image</p>
                <p class="text-xs text-gray-400 mt-1">JPEG, PNG, WEBP — max 2 Mo</p>
            </div>

            {{-- ✅ Champ file caché — même nom que le contrôleur --}}
            <input type="file"
                   id="image_principale"
                   name="image_principale"
                   accept="image/jpeg,image/png,image/webp"
                   class="hidden"
                   onchange="previewImage(event)">

            @error('image_principale')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror

            {{-- ✅ Aperçu : Storage::url() pour les images existantes --}}
            <div id="image_preview" class="mt-3">
                @if(isset($produit) && $produit->image_principale)
                    <img src="{{ Storage::url($produit->image_principale) }}"
                         alt="Image actuelle"
                         class="max-h-40 rounded-xl border border-gray-100 object-cover">
                @endif
            </div>
        </div>

        {{-- Options avancées --}}
        <details class="border border-gray-100 rounded-xl overflow-hidden">
            <summary class="px-4 py-3 text-sm font-medium text-gray-600 cursor-pointer hover:bg-gray-50 transition-colors">
                Options avancées (optionnel)
            </summary>
            <div class="px-4 pb-4 pt-3 space-y-4 border-t border-gray-100">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-600 mb-1.5">Description</label>
                    <textarea id="description"
                              name="description"
                              rows="3"
                              placeholder="Description détaillée du produit..."
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-none">{{ old('description', $produit->description ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-600 mb-1.5">Stock</label>
                        <input type="number"
                               id="stock"
                               name="stock"
                               min="0"
                               value="{{ old('stock', $produit->stock ?? 0) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label for="categorie_id" class="block text-sm font-medium text-gray-600 mb-1.5">Catégorie</label>
                        <select id="categorie_id"
                                name="categorie_id"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">— Aucune —</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    @selected(old('categorie_id', $produit->categorie_id ?? '') == $categorie->id)>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </details>

        {{-- Checkboxes --}}
        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                <input type="checkbox" name="en_promotion"
                       class="rounded"
                       @checked(old('en_promotion', $produit->en_promotion ?? false))>
                En promotion
            </label>
            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                <input type="checkbox" name="en_vedette"
                       class="rounded"
                       @checked(old('en_vedette', $produit->en_vedette ?? false))>
                En vedette
            </label>
            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                <input type="checkbox" name="actif"
                       class="rounded"
                       @checked(old('actif', $produit->actif ?? true))>
                Actif
            </label>
        </div>

        @if($categories->isEmpty())
            <div class="text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">
                Aucune catégorie active. Créez d'abord une catégorie.
            </div>
        @endif

        <div class="pt-2">
            <button type="submit"
                    class="bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-700 active:scale-95 transition-all">
                {{ isset($produit) ? 'Mettre à jour' : 'Enregistrer le produit' }}
            </button>
        </div>
    </form>
</div>

{{-- ✅ Script en bas, hors du form --}}
@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image_preview');
            preview.innerHTML = `<img src="${e.target.result}"
                class="max-h-40 rounded-xl border border-gray-100 object-cover"
                alt="Aperçu">`;
        };
        reader.readAsDataURL(file);
    }

    // Drag & drop
    const zone = document.getElementById('dropZone');
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('bg-gray-50'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('bg-gray-50'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('bg-gray-50');
        const file = e.dataTransfer.files[0];
        if (file?.type.startsWith('image/')) {
            // Injecter le fichier dans l'input
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('image_principale').files = dt.files;
            // Déclencher la prévisualisation
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('image_preview').innerHTML =
                    `<img src="${ev.target.result}" class="max-h-40 rounded-xl border border-gray-100 object-cover" alt="Aperçu">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush