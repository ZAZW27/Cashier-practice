<div x-show="detailOpen" 
     @keydown.escape.window="detailOpen = false"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
     x-cloak>
    
    <div @click.away="detailOpen = false" 
         class="bg-stone-900 border border-stone-800 w-full max-w-5xl max-h-[90vh] overflow-hidden rounded-2xl flex flex-col md:flex-row shadow-2xl">
        
        <div class="md:w-1/2 bg-black flex items-center justify-center">
            <template x-if="selectedProduk">
                <img :src="selectedProduk.gambar" class="object-contain w-full h-full max-h-[500px]">
            </template>
        </div>

        <div class="md:w-1/2 p-8 overflow-y-auto flex flex-col">
            <template x-if="selectedProduk">
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-4xl font-bold text-white" x-text="selectedProduk.nama"></h2>
                        <button @click="detailOpen = false" class="text-stone-500 hover:text-white text-2xl">&times;</button>
                    </div>

                    <p class="text-emerald-400 text-2xl font-mono mb-4" x-text="'Rp ' + Number(selectedProduk.harga).toLocaleString('id-ID')"></p>
                    
                    <div class="mb-6">
                        <h4 class="text-stone-400 uppercase text-xs font-bold tracking-widest mb-2">Description</h4>
                        <p class="text-stone-300 leading-relaxed" x-text="selectedProduk.deskripsi || 'No description available.'"></p>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-white font-bold mb-4 border-b border-stone-800 pb-2">Reviews & Feedbacks</h4>
                        <div class="space-y-4">
                            <template x-for="ulasan in selectedProduk.ulasans" :key="ulasan.id">
                                <div class="bg-stone-800/50 p-4 rounded-xl border border-stone-700">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-emerald-400 font-bold" x-text="'⭐ ' + ulasan.rating"></span>
                                        <span class="text-stone-500 text-xs" x-text="new Date(ulasan.created_at).toLocaleDateString()"></span>
                                    </div>
                                    <p class="text-stone-200 italic" x-text="ulasan.ulasan"></p>
                                    <p class="text-stone-500 text-xs mt-2" x-text="'— ' + ulasan.user.name"></p>
                                </div>
                            </template>
                            <template x-if="selectedProduk.ulasans.length === 0">
                                <p class="text-stone-600 italic">No reviews yet for this product.</p>
                            </template>
                        </div>
                    </div>
                </div>
            </template>

            <div class="mt-8 pt-6 border-t border-stone-800">
                <button @click="addToCart(selectedProduk); detailOpen = false" 
                        class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 rounded-xl transition uppercase tracking-widest">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>