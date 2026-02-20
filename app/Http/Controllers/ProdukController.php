<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(){
        // $produks = Produk::latest()->get(); 
        $produks = DB::table('produks as p')
            ->leftJoin('ulasans as u', 'p.id', '=', 'u.produk_id')
            ->select(
                'p.*', 
                DB::raw('ROUND(AVG(u.rating), 1) as avg_rating')
            )
            ->groupBy('p.id', 'p.nama')->get(); 

        return view('produk.index', compact('produks')); 
    }

    public function show(Produk $produk){
        return view('produk.show', compact('produk')); 
    }

    public function create()
    {
        return view('produk.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk_images', 'public');
            $validated['gambar'] = '/storage/' . $path;
        }

        \App\Models\Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Product added!');
    }

    public function edit(\App\Models\Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, \App\Models\Produk $produk)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Optional: Delete the old image file here if it's not 'default.png'
            $path = $request->file('gambar')->store('produk_images', 'public');
            $validated['gambar'] = 'storage/' . $path;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Product updated successfully!');
    }
}
