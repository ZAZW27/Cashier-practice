
<x-layouts::app :title="__('Shoppe')">
    <div x-data="{ 
        cartOpen: false, 
        cartItems: [],

        get whatsappUrl() {
            let baseUrl = 'https://wa.me/62895704176762?text=';
            let pesan = 'Halo, saya ingin memesan:\n\n';
            
            this.cartItems.forEach((item, index) => {
                pesan += `${index + 1}. ${item.nama} (x${item.quantity})\n`;
            });
            
            let total = this.cartItems.reduce((acc, i) => acc + (i.harga * i.quantity), 0);
            pesan += `\nTotal: Rp ${total.toLocaleString('id-ID')}`;
            
            return baseUrl + encodeURIComponent(pesan);
        },

        detailOpen: false,
        selectedProduk: null,
        async openDetail(id) {
            this.detailOpen = true;
            const response = await fetch(`/api/produks/${id}`);
            this.selectedProduk = await response.json();
        },

        addToCart(produk){
            let found = this.cartItems.find(i=> i.id === produk.id); 
            if(found){
                found.quantity++; 
            }
            else{
                this.cartItems.push({ ...produk, quantity: 1}); 
            }
        },

        clearItems(){
            this.cartItems=[]; 
        }, 

        checkout() {
            if (this.cartItems.length === 0) return alert('cart is empty!');

            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items: this.cartItems })
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Server Error');
                }
                return data;
            })
            .then(data => {
                alert(data.message);
                this.clearItems(); 
                this.cartOpen = false;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Checkout Failed: ' + error.message);
            });
        }
    }" 
    class="relative overflow-x-hidden">
    {{-- {{ auth()->user()->role }} --}}
        <div class="container mx-auto p-6">
            <a href="{{ route('produks.create') }}" class="relative bg-stone-800 border border-stone-600 p-3 rounded-xl hover:bg-stone-700 transition">
                <span class="text-xl">Tambah</span>
            </a>
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
                    @include('produk.partials.cards', ['item' => $item])
                @endforeach
            </div>
        </div>
        @include('produk.partials.cart')
        @include('produk.partials.produk-modal')
    </div>
</x-layouts::app>
