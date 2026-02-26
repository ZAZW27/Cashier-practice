
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
        <template x-for="(item, index) in cartItems" :key="item.id">
            <div class="flex justify-between items-center bg-stone-800 p-3 rounded-xl border border-stone-700">
                <div>
                    <p class="text-white font-medium" x-text="item.nama"></p>
                    <p class="text-emerald-500 text-sm font-mono" x-text="'Rp ' + (item.harga * item.quantity).toLocaleString('id-ID')"></p>
                </div>
                
                <div class="flex items-center gap-3 bg-stone-900 px-3 py-1 rounded-lg border border-stone-700">
                    <button 
                        @click="item.quantity > 1 ? item.quantity-- : cartItems.splice(index, 1)" 
                        class="text-stone-400 hover:text-white font-bold">-</button>
                    
                    <span class="text-white text-sm font-mono" x-text="item.quantity"></span>
                    
                    <button 
                        @click="item.quantity++" 
                        class="text-stone-400 hover:text-white font-bold">+</button>
                </div>
            </div>
        </template>
    </div>

    <div class="absolute bottom-10 left-6 right-6 border-t border-stone-800 pt-6">
        <div class="flex justify-between mb-4 text-white font-bold">
            <span>Total:</span>
            <span class="text-emerald-400" x-text="'Rp ' + cartItems.reduce((acc, i) => (acc + i.harga) * i.quantity, 0).toLocaleString('id-ID')"></span>
        </div>
        
        <a :href="whatsappUrl" 
        target="_blank"
        class="w-full bg-emerald-600 hover:bg-emerald-500 py-4 rounded-2xl font-black uppercase tracking-widest transition inline-block text-center text-white">
            <button @click="checkout()" class="w-full bg-emerald-600 hover:bg-emerald-500 py-4 rounded-2xl font-black uppercase tracking-widest transition">
                Checkout Now
            </button>
        </a>
        <button @click="clearItems()" class="w-full mt-4 bg-sky-600 hover:bg-sky-500 py-4 rounded-2xl font-black uppercase tracking-widest transition">
            Clear cart
        </button>
    </div>
</div>