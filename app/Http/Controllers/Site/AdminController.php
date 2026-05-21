<?php

namespace App\Http\Controllers\Site;

use App\Models\Firestation;
use App\Models\Item;
use App\Models\Movement;
use App\Models\Source;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        // Statistiques
        $totalItems = Item::where('firestation_id', $caserne->id)->count();
        $movementsThisMonth = Movement::whereHas('user', function ($query) use ($caserne) {
            $query->where('firestation_id', $caserne->id);
        })
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year) // ← recommandé sinon ça compte le même mois des années précédentes
            ->count();
        $activeSources = Source::where('firestation_id', $caserne->id)->count();

        // Items en rupture ou proche de la rupture
        $lowStockItems = Item::where('is_stock', true)->where('firestation_id', $caserne->id)->where('state', '=', true)
            ->where(function($query) {
                $query->whereRaw('total_qty <= seuil')
                    ->orWhere('total_qty', '<=', 0);
            })
            ->orderBy('total_qty', 'asc')
            ->get();

        $lowStockCount = $lowStockItems->count();

        return Inertia::render('Admin/Index', [
            'totalItems' => $totalItems,
            'movementsThisMonth' => $movementsThisMonth,
            'activeSources' => $activeSources,
            'lowStockItems' => $lowStockItems,
            'lowStockCount' => $lowStockCount,
        ]);
    }

    public function logout(Request $request){
        // Delete les session
        $request->session()->forget('code');
        $request->session()->forget('email');
        $request->session()->forget('is_admin');
        return redirect('/');
    }

    public function changemode(Request $request){

        $currentMode = $request->session()->get('mode', 'user');
        $newMode = $currentMode === 'admin' ? 'user' : 'admin';
        $request->session()->put('mode', $newMode);

        // Redirige vers la bonne page selon le nouveau mode
        return redirect($newMode === 'admin' ? '/admin' : '/');
    }
}
