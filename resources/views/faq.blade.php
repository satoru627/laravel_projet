@extends('layouts.app')

@section('title', 'Foire aux questions (FAQ)')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Foire aux questions (FAQ)</h1>

    <div class="space-y-6">

        <div class="border rounded-lg p-4 shadow">
            <h2 class="font-semibold text-lg mb-2 text-primary-600">
                Comment puis-je passer une commande ?
            </h2>
            <p>
                Naviguez dans notre catalogue, ajoutez les produits au panier puis suivez le processus de commande jusqu’au paiement.
            </p>
        </div>

        <div class="border rounded-lg p-4 shadow">
            <h2 class="font-semibold text-lg mb-2 text-primary-600">
                Quels sont les moyens de paiement acceptés ?
            </h2>
            <p>
                Nous acceptons les paiements par carte bancaire, mobile money (Orange Money, MTN Mobile Money) et PayPal.
            </p>
        </div>

        <div class="border rounded-lg p-4 shadow">
            <h2 class="font-semibold text-lg mb-2 text-primary-600">
                Livrez-vous dans tout le Cameroun ?
            </h2>
            <p>
                Oui, nous livrons partout au Cameroun. Les délais de livraison varient selon la localité.
            </p>
        </div>

        <div class="border rounded-lg p-4 shadow">
            <h2 class="font-semibold text-lg mb-2 text-primary-600">
                Comment suivre ma commande ?
            </h2>
            <p>
                Après validation de votre commande, vous recevrez un e-mail de confirmation avec un lien pour suivre votre commande dans votre espace client.
            </p>
        </div>

        <div class="border rounded-lg p-4 shadow">
            <h2 class="font-semibold text-lg mb-2 text-primary-600">
                Puis-je retourner un produit ?
            </h2>
            <p>
                Oui, vous pouvez retourner un produit dans les 7 jours suivant la livraison si celui-ci ne correspond pas à vos attentes. Consultez notre page "Retours" pour plus d’informations.
            </p>
        </div>

        <div class="border rounded-lg p-4 shadow">
            <h2 class="font-semibold text-lg mb-2 text-primary-600">
                J’ai une autre question, comment vous contacter ?
            </h2>
            <p>
                Vous pouvez nous contacter via le <a href="{{ route('contact') }}" class="text-primary-500 underline">formulaire de contact</a> ou par email à <span class="font-mono">contact@shopcm.cm</span>.
            </p>
        </div>

    </div>
</div>
@endsection