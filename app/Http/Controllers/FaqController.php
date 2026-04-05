<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Affiche la page FAQ.
     */
    public function faQ()
    {
        return view('faq');
    }
}