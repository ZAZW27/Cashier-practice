<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        $produks = Produk::latest()->get(); 

        return view('produk.index', compact('produks')); 
    }

    public function show(Produk $produk){
        return view('produk.show', compact('produk')); 
    }
}
