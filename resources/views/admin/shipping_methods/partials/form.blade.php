<div class="max-w-3xl mx-auto py-8 px-4">
    <form action="{{ $action }}" method="POST" class="bg-white rounded shadow p-6 space-y-3">
        @csrf
        @if($method !== 'POST') @method($method) @endif
        <input name="name" class="w-full border rounded p-2" placeholder="Nom" value="{{ old('name', $shippingMethod->name ?? '') }}" required>
        <input name="code" class="w-full border rounded p-2" placeholder="Code" value="{{ old('code', $shippingMethod->code ?? '') }}" required>
        <input name="price" type="number" step="0.01" class="w-full border rounded p-2" value="{{ old('price', $shippingMethod->price ?? 0) }}" required>
        <input name="estimated_days" type="number" class="w-full border rounded p-2" value="{{ old('estimated_days', $shippingMethod->estimated_days ?? 5) }}" required>
        <label><input type="checkbox" name="active" @checked(old('active', $shippingMethod->active ?? true))> Actif</label>
        <button class="bg-primary-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
