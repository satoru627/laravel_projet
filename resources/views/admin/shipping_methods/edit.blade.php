@extends('layouts.app')

@section('title', 'Editer livraison')

@section('content')
@include('admin.shipping_methods.partials.form', ['action' => route('admin.shipping-methods.update', $shippingMethod->id), 'method' => 'PUT', 'shippingMethod' => $shippingMethod])
@endsection
