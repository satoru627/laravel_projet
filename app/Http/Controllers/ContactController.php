<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Traite l'envoi du formulaire de contact.
     */
    public function envoyer(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Ici on pourrait envoyer l'email ou stocker le message.
        // Exemple : Mail::to(config('mail.from.address'))->send(new ContactMessage($validated));

        return redirect()->route('contact')->with('success', 'Votre message a bien été envoyé !');
    }
}