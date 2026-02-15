<?php

namespace App\Http\Controllers;

use App\Models\Pembelian; 
use App\Models\Keranjang; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $req) {
    try {
        $req->validate([
            'items' => 'required|array', 
            'items.*.id' => 'required|exists:produks,id', // Removed space after comma
            'items.*.quantity' => 'required|integer|min:1', 
        ]); 

        // Auth::id() correctly returns null for guests
        $pembelian = Pembelian::create([
            'user_id' => Auth::id(), 
            'status' => 'pending',
        ]); 

        foreach($req->items as $item) {
            Keranjang::create([
                'pembelian_id' => $pembelian->id, 
                'produk_id' => $item['id'], 
            ]); 
        }

        return response()->json(['message' => 'Order placed successfully!']); 

    } catch (\Exception $e) {
        // This ensures your JS gets a JSON error message, not an HTML page
        return response()->json(['message' => $e->getMessage()], 500);
    }
}
}
