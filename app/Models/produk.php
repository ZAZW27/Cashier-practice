<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class produk extends Model
{
    protected $fillable = [
        'nama', 
        'stock', 
        'harga', 
        'deskripsi', 
        'gambar'
    ]; 
    public function keranjangs(): HasMany
    {
        return $this->hasMany(keranjang::class); 
    }
}
