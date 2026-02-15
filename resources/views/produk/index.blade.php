<x-layouts::app :title="__('Shoppe')">
    <div x-data="{ 
        cartOpen: false, 
        cartItems: [] 
        addToCart(produk){
            let found = this.cartItems.find(i=> i.id === produk.id); 
            if(found){
                found.quantity++; 
            }
            else{
                this.cartItem.push({ ...product, quantity: 1}); 
            }
        }
    }" class="relative overflow-x-hidden">
        
        <div class="container mx-auto p-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white">Our Products</h1>
                <button @click="cartOpen = true" class="relative bg-stone-800 border border-stone-600 p-3 rounded-xl hover:bg-stone-700 transition">
                    <span class="text-2xl">Cart</span>
                    <template x-if="cartItems.length > 0">
                        <span class="absolute -top-1 -right-1 bg-emerald-500 text-xs font-bold px-1.5 py-0.5 rounded-full" x-text="cartItems.length"></span>
                    </template>
                </button>
            </div>

            <div class="flex flex-row gap-6 justify-center items-start flex-wrap">
                @foreach($produks as $item)
                    <div x-data="{ open: false }" class="card w-2xs bg-stone-700 p-2 rounded-xl shadow-lg border border-stone-600/50 transition-all duration-300">
                        
                        <img class="rounded-md w-full h-40 object-cover" src="{{ $item->gambar }}" alt="{{ $item->nama }}">
                        
                        <section class="my-4 flex flex-col gap-2">
                            <h3 class="font-bold text-white">{{ $item->nama }}</h3>
                            <div class="flex justify-between items-center">
                                <p class="text-emerald-400 font-mono font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                
                                <button @click="open = !open" class="text-stone-400 hover:text-white transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>

                            <div x-show="open" x-collapse x-cloak class="text-sm text-stone-300 bg-stone-800/50 p-3 rounded-lg mt-2">
                                <p class="mb-2">{{ $item->deskripsi }}</p>
                                <div class="text-xs text-stone-400">Stock: {{ $item->stock }} items</div>
                            </div>

                            <button 
                                @click="cartItems.push({ id: {{ $item->id }}, nama: '{{ $item->nama }}', harga: {{ $item->harga }} })"
                                class="w-full mt-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 rounded-lg shadow-md active:scale-95 transition">
                                Add to Cart
                            </button>
                        </section>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-show="cartOpen" x-transition:opacity @click="cartOpen = false" class="fixed inset-0 bg-black/60 z-40 backdrop-blur-sm"></div>

        <div x-show="cartOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed top-0 right-0 h-full w-[30%] bg-stone-900 shadow-2xl z-50 p-6 border-l border-emerald-900/30">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-white italic">Shopping Cart</h2>
                <button @click="cartOpen = false" class="text-stone-500 hover:text-white">&times;</button>
            </div>

            <div class="space-y-4 overflow-y-auto max-h-[70vh]">
                <template x-for="(item, index) in cartItems" :key="index">
                    <div class="flex justify-between items-center bg-stone-800 p-3 rounded-xl border border-stone-700">
                        <div>
                            <p class="text-white font-medium" x-text="item.nama"></p>
                            <p class="text-emerald-500 text-sm font-mono" x-text="'Rp ' + item.harga.toLocaleString('id-ID')"></p>
                        </div>
                        <button @click="cartItems.splice(index, 1)" class="text-red-400 hover:text-red-300 text-xs">
                            Remove
                        </button>
                    </div>
                </template>
                
                <template x-if="cartItems.length === 0">
                    <p class="text-center text-stone-500 mt-10">Your cart is empty...</p>
                </template>
            </div>

            <div class="absolute bottom-10 left-6 right-6 border-t border-stone-800 pt-6">
                <div class="flex justify-between mb-4 text-white font-bold">
                    <span>Total:</span>
                    <span class="text-emerald-400" x-text="'Rp ' + cartItems.reduce((acc, i) => acc + i.harga, 0).toLocaleString('id-ID')"></span>
                </div>
                <button class="w-full bg-emerald-600 hover:bg-emerald-500 py-4 rounded-2xl font-black uppercase tracking-widest transition">
                    Checkout Now
                </button>
            </div>
        </div>
    </div>
</x-layouts::app>