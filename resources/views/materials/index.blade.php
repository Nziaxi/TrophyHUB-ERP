@extends('layouts.app')
@section('title')
  Bahan
@endsection
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h1>daftar bahan</h1>
        <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Tambah Bahan</a>
      </div>
    </div>
    <div class="row">
      @if ($materials->isEmpty())
        <div class="col-12">
          <div class="alert alert-warning">Belum ada bahan terdafatar.</div>
        </div>
      @else
        @foreach ($materials as $item)
          <div class="col-md-4 mb-4">
            <a href="{{ route('materials.edit', $item->id) }}" style="text-decoration: none; color: inherit;">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->material_name }}</h5>
                  <p class="card-text"><strong>Satuan bahan: </strong>{{ $item->unit }}</p>
                  <p class="card-text"><strong>Harga bahan: </strong>{{ number_format($item->price, 0, ',', '.') }} IDR</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection
