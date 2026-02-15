<x-layouts::app :title="__('Dashboard')">
    <div class="container">
        <h1>Our Products</h1>
        <div class="flex flex-row gap-6 justify-center items-start flex-wrap">
            @foreach($produks as $item)
                <div class="card w-2xs bg-stone-700 p-2 rounded-xl hover:shadow-xl shadow-emerald-100/20">
                    <img class="rounded-md" src="{{ $item->gambar }}" alt="{{ $item->nama }}" 
                    class="">
                    <section class="my-4 flex flex-col gap-2">
                        <h3 class="">{{ $item->nama }}</h3>
                        <p>Rp {{ ($item->harga) }}</p>
                        <a
                        class="self-end bg-emerald-700 px-4 py-1.5 rounded-lg shadow"
                        href="{{ route('produk.show', $item->id) }}">View Details</a>
                    </section>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts::app>
