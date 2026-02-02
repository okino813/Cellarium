<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Movement;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Statistiques
        $totalItems = Item::count();
        $movementsThisMonth = Movement::whereMonth('created_at', Carbon::now()->month)->count();
        $activeSources = Source::count();

        // Items en rupture ou proche de la rupture
        $lowStockItems = Item::where('is_stock', true)->where('state', '=', true)
            ->where(function($query) {
                $query->whereRaw('total_qty <= seuil')
                    ->orWhere('total_qty', '<=', 0);
            })
            ->orderBy('total_qty', 'asc')
            ->get();

        $lowStockCount = $lowStockItems->count();

        return view('admin.index', compact(
            'totalItems',
            'movementsThisMonth',
            'activeSources',
            'lowStockItems',
            'lowStockCount'
        ));
    }

    public function logout(Request $request){
        // Delete les session
        $request->session()->forget('code');
        $request->session()->forget('email');
        $request->session()->forget('is_admin');
        return redirect('/');
    }
}
