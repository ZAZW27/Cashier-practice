<x-layouts::app :title="__('Add New Product')">
    <div class="container mx-auto p-6 max-w-2xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Add New Product</h1>
            <a href="{{ route('produk.index') }}" class="text-stone-400 hover:text-white transition">Back to Shop</a>
        </div>

        <div class="bg-stone-800 border border-stone-700 p-8 rounded-2xl shadow-xl">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-stone-300 mb-2">Product Name</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition">
                    @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-stone-300 mb-2">Price (Rp)</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" required
                            class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-300 mb-2">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" required
                            class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-stone-300 mb-2">Description</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full bg-stone-900 border border-stone-600 rounded-xl px-4 py-3 text-white focus:border-emerald-500 outline-none">{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-stone-300 mb-2">Product Image</label>
                    <input type="file" name="gambar" 
                        class="w-full text-stone-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500 cursor-pointer">
                    <p class="text-xs text-stone-500 mt-2 italic">Leave empty to use default.png</p>
                </div>

                <button type="submit" 
                    class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 rounded-xl shadow-lg active:scale-[0.98] transition-all uppercase tracking-widest">
                    Save Product
                </button>
            </form>
        </div>
    </div>
</x-layouts::app>