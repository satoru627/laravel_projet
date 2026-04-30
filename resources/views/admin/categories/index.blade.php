@extends('layouts.app')
@section('title', 'Catégories')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
<div class="max-w-5xl mx-auto px-4">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/>
                </svg>
            </span>
            Gestion des Catégories
        </h1>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvelle Catégorie
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
    <div class="flex items-center gap-3 bg-green-50 border border-green-100 text-green-700 text-sm px-4 py-3 rounded-xl mb-5">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">

        {{-- Toolbar --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <span class="text-sm font-semibold text-gray-500">
                {{ $categories->count() }} catégorie{{ $categories->count() > 1 ? 's' : '' }}
            </span>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" id="searchInput" oninput="filterRows()"
                       placeholder="Rechercher..."
                       class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-100 focus:border-red-300 transition w-56">
            </div>
        </div>

        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nom</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Produits</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Statut</th>
                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-gray-50">
            @forelse($categories as $categorie)
                <tr class="hover:bg-gray-50 transition-colors"
                    data-search="{{ strtolower($categorie->nom) }}">

                    {{-- Nom --}}
                    <td class="px-5 py-4">
                        <span class="font-semibold text-sm text-gray-800">{{ $categorie->nom }}</span>
                    </td>

                    {{-- Produits --}}
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                            </svg>
                            {{ $categorie->produits_count }} produit{{ $categorie->produits_count > 1 ? 's' : '' }}
                        </span>
                    </td>

                    {{-- Statut --}}
                    <td class="px-5 py-4">
                        @if($categorie->actif)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>
                                Actif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-400 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300 inline-block"></span>
                                Inactif
                            </span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.categories.show', $categorie->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-500 bg-gray-50 border border-gray-200 rounded-lg hover:border-gray-300 hover:text-gray-700 transition-all">
                                Voir
                            </a>
                            <a href="{{ route('admin.categories.edit', $categorie->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-500 bg-gray-50 border border-gray-200 rounded-lg hover:border-gray-300 hover:text-gray-700 transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editer
                            </a>

                            {{-- Suppression avec confirmation --}}
                            <div class="relative del-wrap">
                                <button type="button" onclick="toggleDel(this)"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-500 bg-red-50 border border-red-100 rounded-lg hover:bg-red-500 hover:text-white hover:border-red-500 transition-all">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Supprimer
                                </button>
                                <div class="del-box hidden absolute top-full right-0 mt-2 z-50 bg-white border border-gray-100 rounded-2xl shadow-xl p-4 w-60">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="w-6 h-6 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                            </svg>
                                        </span>
                                        <p class="text-xs font-bold text-gray-700">Confirmer la suppression</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mb-3 leading-relaxed pl-8">
                                        Supprimer <span class="font-semibold text-gray-600">{{ $categorie->nom }}</span> ? Cette action est irréversible.
                                    </p>
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.categories.destroy', $categorie->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-lg transition-all">
                                                Confirmer
                                            </button>
                                        </form>
                                        <button type="button" onclick="closeDel(this)"
                                                class="flex-1 py-1.5 border border-gray-200 text-gray-400 text-xs font-semibold rounded-lg hover:bg-gray-50 transition-all">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-12 text-center text-sm text-gray-300">
                        Aucune catégorie trouvée.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Footer --}}
        <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between">
            @if(method_exists($categories, 'currentPage'))
                <span class="text-xs text-gray-300 font-mono">
                    Page {{ $categories->currentPage() }} / {{ $categories->lastPage() }}
                </span>
                <div>{{ $categories->links() }}</div>
            @else
                <span class="text-xs text-gray-300 font-mono">
                    {{ $categories->count() }} résultat{{ $categories->count() > 1 ? 's' : '' }}
                </span>
                <span></span>
            @endif
        </div>
    </div>

</div>
</div>

<script>
function toggleDel(btn) {
    const box = btn.closest('.del-wrap').querySelector('.del-box');
    const isOpen = !box.classList.contains('hidden');
    document.querySelectorAll('.del-box').forEach(b => b.classList.add('hidden'));
    if (!isOpen) box.classList.remove('hidden');
}
function closeDel(btn) {
    btn.closest('.del-box').classList.add('hidden');
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.del-wrap')) {
        document.querySelectorAll('.del-box').forEach(b => b.classList.add('hidden'));
    }
});
function filterRows() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#tableBody tr[data-search]').forEach(row => {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
}
</script>
@endsection