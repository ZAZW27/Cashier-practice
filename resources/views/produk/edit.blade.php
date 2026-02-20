<x-layouts::app :title="__('Edit Product')">
    <div class="container mx-auto p-6 max-w-2xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Edit: {{ $produk->nama }}</h1>
            <a href="{{ route('produk.index') }}" class="text-stone-400 hover:text-white transition">Cancel</a>
        </div>

        <div class="bg-stone-800 border border-stone-700 p-8 rounded-2xl shadow-xl">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') <div>
                    <label class="block text-sm font-medium text-stone-300 mb-2">Product Name</label>
                    <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" required
                        class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-stone-300 mb-2">Price (Rp)</label>
                        <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" required
                            class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-300 mb-2">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock', $produk->stock) }}" required
                            class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-stone-300 mb-2">Description</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-stone-300 mb-2">Current Image</label>
                    <img src="{{ asset($produk->gambar) }}" class="w-32 h-32 object-cover rounded-lg mb-4 border border-stone-600">
                    
                    <label class="block text-sm font-medium text-stone-300 mb-2">Change Image (Optional)</label>
                    <input type="file" name="gambar" class="w-full text-stone-400 file:bg-emerald-600 file:text-white file:rounded-full file:border-0 file:px-4 file:py-2">
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 rounded-xl shadow-lg transition-all uppercase tracking-widest">
                    Update Product
                </button>
            </form>
        </div>
    </div>
</x-layouts::app>