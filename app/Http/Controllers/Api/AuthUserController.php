<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Firestation;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    public function loginUser(Request $request)
    {
        $credentials = $request->only('code', 'firstname');

        // Vérifie que la caserne existe
        $firestation = Firestation::where('code', $credentials['code'])->first();
        if (!$firestation) {
            return response()->json(['error' => 'Code caserne invalide'], 401);
        }

        // On récupère n'importe quel user lié à cette caserne
        // ou on crée un "user générique" pour générer le token
        $user = User::where('firestation_id', $firestation->id)->first();
        if (!$user) {
            return response()->json(['error' => 'Aucun utilisateur trouvé'], 401);
        }

        // Génère le token sans vérifier le mot de passe
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api_user')->factory()->getTTL() * 60,
            'firstname'    => $credentials['firstname'],
            'firestation'  => $firestation->city,
        ]);
    }

    public function refreshUser()
    {
        return response()->json([
            'access_token' => auth('api_user')->refresh(),
            'token_type'   => 'bearer',
        ]);
    }
}
