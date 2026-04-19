<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Firestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthAdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('code','email', 'password');

        $firestation = Firestation::where('code', $credentials['code'])->with("admins")->first();

        Log::info($firestation);
        if(!$firestation){
            return response()->json([
                'error' => "Code caserne invalide"
            ], 401);
        }


        if (!$token = auth('api_admin')->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Log::info($credentials);


        // Get la relation avec l'id user
        foreach ($firestation->admins as $admin) {
            if ($admin->email == $credentials['email']) {
                return response()->json([
                    'access_token' => $token,
                    'token_type'   => 'bearer',
                    'expires_in'   => auth('api_admin')->factory()->getTTL() * 60,
                ]);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);


    }

    public function refreshAdmin()
    {
        return response()->json([
            'access_token' => auth('api_admin')->refresh(),
            'token_type'   => 'bearer',
        ]);
    }
}
