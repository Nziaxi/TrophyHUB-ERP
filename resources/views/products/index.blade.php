@extends('layouts.app')

@section('title')
    Daftar Produk
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1>Daftar Produk</h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
            </div>
        </div>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <!-- Gambar Produk -->
                        @if($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="No image available" style="height: 200px; object-fit: cover;">
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text"><strong>Kategori: </strong>{{ $product->category }}</p>
                            <p class="card-text"><strong>Harga Jual: </strong>{{ number_format($product->selling_price, 0, ',', '.') }} IDR</p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Tidak ada produk yang ditemukan.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
