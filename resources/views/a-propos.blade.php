<!-- about -->
@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-4">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-primary-700">À propos de ShopCM</h1>
        <p class="text-gray-700 text-lg mb-4">
            ShopCM est une boutique en ligne camerounaise dédiée à offrir une expérience d’achat simple, rapide et fiable. Nous sélectionnons avec soin nos produits pour répondre aux besoins de toutes les familles et entrepreneurs du Cameroun.
        </p>
        <p class="text-gray-700 text-lg mb-4">
            Depuis notre création, nous nous engageons à mettre la <span class="font-semibold text-primary-600">satisfaction client</span> au cœur de notre mission. Profitez de promotions régulières, d’une livraison rapide partout au Cameroun et d’un service client à l’écoute.
        </p>
        <p class="text-gray-700 text-lg mb-4">
            Notre équipe travaille quotidiennement pour vous apporter une sélection de produits innovants, tendances et de grande qualité à des prix compétitifs.
        </p>
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-primary-700 mb-2">Nos valeurs :</h2>
            <ul class="list-disc ml-8 text-gray-600">
                <li>Fiabilité des produits et du service</li>
                <li>Respect du client et transparence</li>
                <li>Innovation et amélioration continue</li>
                <li>Engagement local au Cameroun</li>
            </ul>
        </div>
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-primary-700 mb-2">Contactez-nous</h2>
            <p class="text-gray-700">
                Pour toute question, suggestion ou partenariat, n’hésitez pas à nous contacter via notre <a href="/" class="text-primary-600 font-medium hover:underline">formulaire de contact</a>.
            </p>
        </div>
    </div>
</div>
@endsection