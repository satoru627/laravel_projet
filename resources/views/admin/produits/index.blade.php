@extends('layouts.app')

@section('title', 'Produits — Admin')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Syne:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --primary: #e8294a;
    --primary-hover: #c41f38;
    --primary-light: #fde8eb;
    --bg-page: #f3f4f6;
    --bg-card: #ffffff;
    --bg-row-hover: #fafafa;
    --border: #e5e7eb;
    --text-main: #1a1a2a;
    --text-muted: #6b7280;
    --text-hint: #9ca3af;
    --font-main: 'Syne', sans-serif;
    --font-mono: 'JetBrains Mono', monospace;
}

.ap-root { font-family: var(--font-main); padding: 2rem 0; background: var(--bg-page); min-height: 100vh; }
.ap-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; }
.ap-title-block { display: flex; align-items: center; gap: 12px; }
.ap-icon { font-size: 28px; line-height: 1; }
.ap-title { font-size: 24px; font-weight: 700; color: var(--text-main); letter-spacing: -0.02em; }
.ap-subtitle { font-size: 12px; color: var(--text-hint); margin-top: 2px; font-family: var(--font-mono); }

.ap-btn-add { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-family: var(--font-main); font-size: 14px; font-weight: 700; cursor: pointer; text-decoration: none; transition: background 0.15s; }
.ap-btn-add:hover { background: var(--primary-hover); color: #fff; text-decoration: none; }
.ap-btn-add svg { width: 15px; height: 15px; stroke: #fff; fill: none; stroke-width: 3; stroke-linecap: round; }

.ap-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 1.75rem; }
.ap-stat { background: var(--bg-card); border: 1px solid var(--border); border-radius: 10px; padding: 1rem 1.25rem; }
.ap-stat-label { font-size: 11px; color: var(--text-hint); text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--font-mono); margin-bottom: 6px; }
.ap-stat-val { font-size: 24px; font-weight: 700; font-family: var(--font-mono); color: var(--text-main); }
.ap-stat-val.accent { color: var(--primary); }
.ap-stat-val.green { color: #16a34a; }
.ap-stat-val.amber { color: #d97706; }
.ap-stat-accent-bar { height: 3px; background: var(--primary); border-radius: 2px; margin-top: 10px; width: 32px; }

.ap-table-wrap { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; overflow: visible; }

.ap-toolbar { display: flex; align-items: center; gap: 10px; padding: 14px 16px; border-bottom: 1px solid var(--border); }
.ap-search { flex: 1; display: flex; align-items: center; gap: 8px; background: var(--bg-page); border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; transition: border-color 0.15s; }
.ap-search:focus-within { border-color: var(--primary); }
.ap-search svg { width: 14px; height: 14px; stroke: var(--text-hint); fill: none; stroke-width: 2; stroke-linecap: round; flex-shrink: 0; }
.ap-search input { border: none; background: transparent; font-size: 13px; color: var(--text-main); outline: none; width: 100%; font-family: var(--font-mono); }
.ap-search input::placeholder { color: var(--text-hint); }

.ap-table-wrap table { width: 100%; border-collapse: collapse; table-layout: fixed; }
.ap-table-wrap thead tr { background: var(--bg-page); }
.ap-table-wrap th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-hint); font-family: var(--font-mono); padding: 12px 16px; text-align: left; border-bottom: 1px solid var(--border); }
.ap-table-wrap th.right { text-align: right; }
.ap-table-wrap th.center { text-align: center; }
.ap-table-wrap th:nth-child(1) { width: 34%; }
.ap-table-wrap th:nth-child(2) { width: 17%; }
.ap-table-wrap th:nth-child(3) { width: 17%; }
.ap-table-wrap th:nth-child(4) { width: 13%; }
.ap-table-wrap th:nth-child(5) { width: 19%; }

.ap-table-wrap td { padding: 14px 16px; font-size: 14px; color: var(--text-main); border-bottom: 1px solid var(--border); vertical-align: middle; }
.ap-table-wrap tr:last-child td { border-bottom: none; }
.ap-table-wrap tbody tr { transition: background 0.1s; }
.ap-table-wrap tbody tr:hover { background: #fdf2f4; }

.prod-name { font-weight: 600; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
.prod-avatar { width: 32px; height: 32px; border-radius: 8px; background: var(--primary-light); border: 1px solid #f9c0cb; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 11px; font-weight: 700; color: var(--primary); }

.cat-badge { display: inline-flex; align-items: center; font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 5px; font-family: var(--font-mono); }

.prix-cell { font-family: var(--font-mono); font-size: 14px; font-weight: 600; text-align: right; color: var(--text-main); }
.prix-cell .unit { font-size: 11px; color: var(--text-hint); font-weight: 400; }

.stock-wrap { display: flex; align-items: center; justify-content: center; }
.stock-badge { font-family: var(--font-mono); font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 5px; }
.stock-ok  { background: #dcfce7; color: #166534; }
.stock-low { background: #fef3c7; color: #92400e; }
.stock-out { background: var(--primary-light); color: var(--primary); }

.actions { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
.btn-edit { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 6px; border: 1px solid var(--border); background: transparent; font-size: 12px; color: var(--text-muted); text-decoration: none; font-family: var(--font-main); font-weight: 600; transition: all 0.12s; cursor: pointer; }
.btn-edit:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); text-decoration: none; }
.btn-edit svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; }

.btn-del { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 6px; border: 1px solid #f9c0cb; background: transparent; font-size: 12px; color: var(--primary); cursor: pointer; font-family: var(--font-main); font-weight: 600; transition: all 0.12s; }
.btn-del:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
.btn-del:hover svg { stroke: #fff; }
.btn-del svg { width: 12px; height: 12px; stroke: var(--primary); fill: none; stroke-width: 2; stroke-linecap: round; transition: stroke 0.12s; }

.ap-footer { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; border-top: 1px solid var(--border); background: var(--bg-page); border-radius: 0 0 12px 12px; }
.ap-page-info { font-size: 12px; color: var(--text-hint); font-family: var(--font-mono); }

/* Confirmation suppression */
.del-row-wrap { position: relative; }
.del-confirm-box { display: none; position: absolute; top: calc(100% + 6px); right: 0; z-index: 100; background: var(--bg-card); border: 1px solid var(--border); border-radius: 10px; padding: 14px; min-width: 220px; box-shadow: 0 4px 20px rgba(232,41,74,0.08); }
.del-confirm-box.open { display: block; }
.conf-header { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.conf-header svg { width: 16px; height: 16px; stroke: var(--primary); fill: none; stroke-width: 2; stroke-linecap: round; }
.conf-title { font-size: 13px; font-weight: 700; color: var(--text-main); }
.conf-text { font-size: 12px; color: var(--text-muted); margin-bottom: 12px; line-height: 1.5; }
.conf-text strong { color: var(--text-main); }
.conf-btns { display: flex; gap: 6px; }
.conf-yes { flex: 1; padding: 7px; background: var(--primary); color: #fff; border: none; border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer; font-family: var(--font-main); transition: background 0.12s; }
.conf-yes:hover { background: var(--primary-hover); }
.conf-no { flex: 1; padding: 7px; background: transparent; border: 1px solid var(--border); border-radius: 6px; font-size: 12px; color: var(--text-muted); cursor: pointer; font-family: var(--font-main); transition: background 0.12s; }
.conf-no:hover { background: var(--bg-page); }

/* Flash message */
.flash-success { padding: 12px 16px; background: #dcfce7; color: #166534; font-size: 13px; border-bottom: 1px solid #bbf7d0; display: flex; align-items: center; gap: 8px; }
.flash-success svg { width: 14px; height: 14px; stroke: #16a34a; fill: none; stroke-width: 2.5; stroke-linecap: round; }
.flash-error { padding: 12px 16px; background: var(--primary-light); color: var(--primary); font-size: 13px; border-bottom: 1px solid #f9c0cb; display: flex; align-items: center; gap: 8px; }

/* Pagination override */
.ap-pagination nav { display: flex; }
.ap-pagination .pagination { display: flex; gap: 4px; list-style: none; padding: 0; margin: 0; }
.ap-pagination .page-item .page-link { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 6px; border: 1px solid var(--border); background: transparent; font-size: 12px; color: var(--text-muted); font-family: var(--font-mono); text-decoration: none; transition: all 0.12s; }
.ap-pagination .page-item.active .page-link { background: var(--primary); border-color: var(--primary); color: #fff; font-weight: 700; }
.ap-pagination .page-item .page-link:hover { border-color: var(--primary); color: var(--primary); }
</style>
@endpush

@section('content')
<div class="ap-root">
<div class="max-w-6xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="ap-header">
        <div class="ap-title-block">
            <div class="ap-icon">🛍️</div>
            <div>
                <div class="ap-title">Gestion des Produits</div>
                <div class="ap-subtitle">admin / catalogue</div>
            </div>
        </div>
        <a href="{{ route('admin.produits.create') }}" class="ap-btn-add">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouveau produit
        </a>
    </div>

    {{-- KPI Cards --}}
    @php
        $totalProduits   = $produits->total();
        $enStock         = $produits->getCollection()->where('stock', '>', 3)->count();
        $stockFaible     = $produits->getCollection()->where('stock', '<=', 3)->where('stock', '>', 0)->count();
    @endphp
    <div class="ap-stats">
        <div class="ap-stat">
            <div class="ap-stat-label">Total produits</div>
            <div class="ap-stat-val accent">{{ $totalProduits }}</div>
            <div class="ap-stat-accent-bar"></div>
        </div>
        <div class="ap-stat">
            <div class="ap-stat-label">En stock</div>
            <div class="ap-stat-val green">{{ $enStock }}</div>
        </div>
        <div class="ap-stat">
            <div class="ap-stat-label">Stock faible</div>
            <div class="ap-stat-val amber">{{ $stockFaible }}</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="ap-table-wrap">

        {{-- Toolbar --}}
        <div class="ap-toolbar">
            <div class="ap-search">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" id="searchInput" placeholder="Rechercher un produit ou catégorie..." oninput="filterRows()">
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
        <div class="flash-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-error">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th class="right">Prix (FCFA)</th>
                    <th class="center">Stock</th>
                    <th class="right">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            @forelse($produits as $produit)
                @php
                    $nom      = $produit->nom;
                    $initiales = collect(explode(' ', $nom))->take(2)->map(fn($w) => strtoupper($w[0] ?? ''))->join('');
                    $stock    = $produit->stock;
                    $stockClass = $stock === 0 ? 'stock-out' : ($stock <= 3 ? 'stock-low' : 'stock-ok');
                    $stockLabel = $stock === 0 ? 'Épuisé' : ($stock <= 3 ? $stock . ' — Faible' : $stock . ' unités');
                    $catNom   = $produit->categorie->nom ?? 'Autre';
                    $catPalette = [
                        'Électronique' => ['bg' => '#E6F1FB', 'color' => '#185FA5'],
                        'Mode'         => ['bg' => '#EEEDFE', 'color' => '#534AB7'],
                        'Sport'        => ['bg' => '#E1F5EE', 'color' => '#0F6E56'],
                        'Beauté'       => ['bg' => '#FBEAF0', 'color' => '#993556'],
                        'Alimentation' => ['bg' => '#FEF3C7', 'color' => '#92400E'],
                        'Maison'       => ['bg' => '#F1EFE8', 'color' => '#5F5E5A'],
                    ];
                    $catStyle = $catPalette[$catNom] ?? ['bg' => '#fde8eb', 'color' => '#e8294a'];
                @endphp
                <tr data-search="{{ strtolower($nom . ' ' . $catNom) }}">
                    <td>
                        <div class="prod-name">
                            <div class="prod-avatar">{{ $initiales }}</div>
                            {{ $nom }}
                        </div>
                    </td>
                    <td>
                        <span class="cat-badge" style="background:{{ $catStyle['bg'] }};color:{{ $catStyle['color'] }}">
                            {{ $catNom }}
                        </span>
                    </td>
                    <td class="prix-cell">
                        {{ number_format($produit->prix, 0, ',', ' ') }}
                        <span class="unit">FCFA</span>
                    </td>
                    <td>
                        <div class="stock-wrap">
                            <span class="stock-badge {{ $stockClass }}">{{ $stockLabel }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="actions del-row-wrap">
                            <a href="{{ route('admin.produits.edit', $produit->id) }}" class="btn-edit">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Editer
                            </a>
                            <button class="btn-del" type="button" onclick="toggleConfirm(this)">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                Supprimer
                            </button>
                            <div class="del-confirm-box">
                                <div class="conf-header">
                                    <svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                    <span class="conf-title">Confirmer la suppression</span>
                                </div>
                                <div class="conf-text">Supprimer <strong>{{ $nom }}</strong> ?<br>Cette action est irréversible.</div>
                                <div class="conf-btns">
                                    <form action="{{ route('admin.produits.destroy', $produit->id) }}" method="POST" style="flex:1;display:flex;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="conf-yes" style="width:100%">Supprimer</button>
                                    </form>
                                    <button type="button" class="conf-no" onclick="closeConfirm(this)">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:3rem;color:var(--text-hint);font-family:var(--font-mono);font-size:13px;">
                        Aucun produit trouvé.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Footer --}}
        <div class="ap-footer">
            <div class="ap-page-info">
                Page {{ $produits->currentPage() }} / {{ $produits->lastPage() }}
                &mdash; {{ $produits->total() }} produit(s)
            </div>
            <div class="ap-pagination">
                {{ $produits->links() }}
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@push('scripts')
<script>
function toggleConfirm(btn) {
    const box = btn.closest('.del-row-wrap').querySelector('.del-confirm-box');
    const isOpen = box.classList.contains('open');
    document.querySelectorAll('.del-confirm-box.open').forEach(b => b.classList.remove('open'));
    if (!isOpen) box.classList.add('open');
}

function closeConfirm(btn) {
    btn.closest('.del-confirm-box').classList.remove('open');
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.del-row-wrap')) {
        document.querySelectorAll('.del-confirm-box.open').forEach(b => b.classList.remove('open'));
    }
});

function filterRows() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#tableBody tr[data-search]').forEach(row => {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
}
</script>
@endpush