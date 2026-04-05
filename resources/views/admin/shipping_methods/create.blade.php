@extends('layouts.app')

@section('title', 'Ajouter livraison')

@section('content')
@include('admin.shipping_methods.partials.form', ['action' => route('admin.shipping-methods.store'), 'method' => 'POST', 'shippingMethod' => null])
@endsection
