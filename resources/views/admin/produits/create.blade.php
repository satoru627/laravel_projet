@extends('layouts.app')

@section('title', 'Ajouter produit')

@section('content')
@include('admin.produits.partials.form', ['action' => route('admin.produits.store'), 'method' => 'POST', 'produit' => null])
@endsection
