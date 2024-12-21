@extends('layouts.app')
@section('title')
  Daftar BoM
@endsection
@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="mb-4">Daftar Bill of Materials (BoM)</h1>
      <a href="{{ route('bom.create') }}" class="btn btn-primary">Tambah BoM</a>
    </div>

    <!-- Tabel BoM -->
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Kode BoM</th>
          <th>Nama Produk</th>
          {{-- <th>Jumlah Komponen</th> --}}
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($boms as $index => $bom)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $bom->bom_code }}</td>
            <td>{{ $bom->product->product_name }}</td>
            {{-- <td>{{ $bom->bomComponents->count() }}</td> --}}
            <td>
              <a href="{{ route('bom.edit', $bom->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('bom.destroy', $bom->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus BoM ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum ada data BoM</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
