<div class="container">
    <h1>Our Products</h1>
    <div class="grid">
        @foreach($produks as $item)
            <div class="card">
                <img src="{{ $item->gambar }}" alt="{{ $item->nama }}" style="width:200px">
                <h3>{{ $item->nama }}</h3>
                <p>Rp {{ ($item->harga) }}</p>
                <a href="{{ route('produk.show', $item->id) }}">View Details</a>
            </div>
        @endforeach
    </div>
</div>