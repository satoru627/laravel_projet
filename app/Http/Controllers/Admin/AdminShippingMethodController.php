<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class AdminShippingMethodController extends Controller
{
    public function index()
    {
        $shippingMethods = ShippingMethod::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.shipping_methods.index', compact('shippingMethods'));
    }

    public function create()
    {
        return view('admin.shipping_methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:shipping_methods,code',
            'price' => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
        ]);

        ShippingMethod::create($validated + ['active' => $request->boolean('active')]);
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Mode de livraison cree.');
    }

    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping_methods.edit', compact('shippingMethod'));
    }

    public function update(Request $request, ShippingMethod $shippingMethod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:shipping_methods,code,'.$shippingMethod->id,
            'price' => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
        ]);

        $shippingMethod->update($validated + ['active' => $request->boolean('active')]);
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Mode de livraison mis a jour.');
    }

    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Mode de livraison supprime.');
    }
}
