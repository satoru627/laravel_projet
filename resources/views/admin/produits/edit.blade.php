@extends('layouts.app')

@section('title', 'Editer produit')

@section('content')
@include('admin.produits.partials.form', ['action' => route('admin.produits.update', $produit->id), 'method' => 'PUT', 'produit' => $produit])
@endsection
