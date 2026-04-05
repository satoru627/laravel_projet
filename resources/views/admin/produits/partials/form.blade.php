<div class="max-w-3xl mx-auto py-8 px-4">
    <form action="{{ $action }}" method="POST" class="bg-white rounded shadow p-6 space-y-3">
        @csrf
        @if($method !== 'POST') @method($method) @endif
        <h2 class="text-lg font-semibold mb-3">Ajout rapide produit</h2>
        <input name="nom" class="w-full border rounded p-2" placeholder="Nom du produit" value="{{ old('nom', $produit->nom ?? '') }}" required>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <input name="prix" type="number" step="0.01" class="border rounded p-2" value="{{ old('prix', $produit->prix ?? 0) }}" required placeholder="Prix">
            <input name="prix_promo" type="number" step="0.01" class="border rounded p-2" value="{{ old('prix_promo', $produit->prix_promo ?? '') }}" placeholder="Prix promo (optionnel)">
        </div>

        <div class="mb-2">
            <label class="block font-medium mb-1">Image principale</label>
    
          
            <!-- ou URL d'image existante -->
            <input name="image_principale" class="w-full border rounded p-2 mt-2" placeholder="URL image du produit" value="{{ old('image_principale', $produit->image_principale ?? '') }}">
            
            
            <div id="image_preview" class="mt-2">
                @php
                    $imageUrl = old('image_principale', $produit->image_principale ?? '');
                @endphp
                @if($imageUrl)
                    <img src="{{ $imageUrl }}" alt="Aperçu de l'image" class="max-h-32 rounded border">
                @endif
            </div>
        </div>
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('image_preview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        let img = preview.querySelector('img');
                        if (!img) {
                            img = document.createElement('img');
                            img.className = "max-h-32 rounded border";
                            preview.innerHTML = "";
                            preview.appendChild(img);
                        }
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        
        
        <details class="border rounded p-3">
            <summary class="cursor-pointer font-medium">Options avancees (optionnel)</summary>
            <div class="mt-3 space-y-3">
                <textarea name="description" class="w-full border rounded p-2" placeholder="Description">{{ old('description', $produit->description ?? '') }}</textarea>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input name="stock" type="number" class="border rounded p-2" value="{{ old('stock', $produit->stock ?? 0) }}" placeholder="Stock">
                    <select name="categorie_id" class="border rounded p-2">
                        <option value="">Categorie par defaut</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" @selected(old('categorie_id', $produit->categorie_id ?? '') == $categorie->id)>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </details>

        <div class="space-x-3">
            <label><input type="checkbox" name="en_promotion" @checked(old('en_promotion', $produit->en_promotion ?? false))> Promo</label>
            <label><input type="checkbox" name="en_vedette" @checked(old('en_vedette', $produit->en_vedette ?? false))> Vedette</label>
            <label><input type="checkbox" name="actif" @checked(old('actif', $produit->actif ?? true))> Actif</label>
        </div>
        @if($categories->isEmpty())
            <p class="text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded p-2">
                Aucune categorie active. Cree d'abord une categorie.
            </p>
        @endif
        <button class="bg-primary-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
