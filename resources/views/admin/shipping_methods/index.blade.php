@extends('layouts.app')

@section('title', 'Modes livraison')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Modes de livraison</h1>
        <a href="{{ route('admin.shipping-methods.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded">Ajouter</a>
    </div>
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100"><tr><th class="p-3 text-left">Nom</th><th class="p-3">Code</th><th class="p-3">Prix</th><th></th></tr></thead>
            <tbody>
                @foreach($shippingMethods as $method)
                <tr class="border-t">
                    <td class="p-3">{{ $method->name }}</td>
                    <td class="p-3">{{ $method->code }}</td>
                    <td class="p-3">{{ number_format($method->price, 2) }}</td>
                    <td class="p-3 text-right"><a class="text-blue-600" href="{{ route('admin.shipping-methods.edit', $method->id) }}">Editer</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
