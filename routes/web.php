<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Page principale
Route::get('/', function () {
    $password = Str::password(16, true, true, true);
    
    return view('password', compact('password'));
});

// Génération d'un mot de passe avec une longueur choisie
Route::get('/password/{length}', function ($length) {
    if (!is_numeric($length) || $length < 8 || $length > 64) {
        abort(400, 'La longueur doit être un nombre entre 8 et 64 caractères.');
    }

    $password = Str::password((int)$length, true, true, true);
    return view('password', compact('password'));
})->where('length', '[0-9]+');

// Vérification de la sécurité
Route::post('/audit', function (Request $request) {
    $request->validate([
        'user_password' => 'required|string|min:1',
    ]);

    $testedPassword = $request->input('user_password');
    
    $score = 0;
    $feedback = [];

    // Vérification de la longueur
    if (strlen($testedPassword) >= 12) {
        $score += 2;
    } elseif (strlen($testedPassword) >= 8) {
        $score += 1;
    } else {
        $feedback[] = "Trop court (Moins de 8 caractères).";
    }

    // Vérification des différents types de caractères
    if (preg_match('/[A-Z]/', $testedPassword)) {
        $score += 1;
    } else {
        $feedback[] = "Manque une majuscule.";
    }

    if (preg_match('/[a-z]/', $testedPassword)) {
        $score += 1;
    }

    if (preg_match('/[0-9]/', $testedPassword)) {
        $score += 1;
    } else {
        $feedback[] = "Manque un chiffre.";
    }

    if (preg_match('/[^A-Za-z0-9]/', $testedPassword)) {
        $score += 1;
    } else {
        $feedback[] = "Manque un caractère spécial.";
    }

    if ($score >= 5) {
        $strength = ['label' => 'Excellent', 'color' => '#10b981'];
    } elseif ($score >= 3) {
        $strength = ['label' => 'Moyen', 'color' => '#f59e0b'];
    } else {
        $strength = ['label' => 'Critique / Faible', 'color' => '#ef4444'];
    }

    $password = Str::password(16, true, true, true);
    $result = [
        'password' => $testedPassword,
        'label' => $strength['label'],
        'color' => $strength['color'],
        'feedback' => $feedback
    ];

    return view('password', compact('password', 'result'));
})->name('password.audit');
