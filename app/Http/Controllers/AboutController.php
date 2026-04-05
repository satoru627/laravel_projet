<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Affiche la page "À propos"
     */
    public function index()
    {
        return view('a-propos');
    }
} 

