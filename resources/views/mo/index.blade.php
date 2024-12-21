@extends('layouts.app')

@section('title')
  Manufacturing Order
@endsection

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="mb-4">Daftar Manufacturing Order</h1>
      <a href="{{ route('mo.create') }}" class="btn btn-primary">Tambah MO</a>
    </div>
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode BoM</th>
          <th>Tanggal Jadwal</th>
          <th>Produk</th>
          <th>Status Material</th>
          <th>Quantity</th>
          <th>Status Produksi</th>
          <th>Aksi</th> <!-- Tombol edit untuk setiap row -->
        </tr>
      </thead>
      <tbody>
        @forelse ($manufacturingOrders as $index => $mo)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $mo->bom ? $mo->bom->bom_code : 'No BOM available' }}</td>
            <td>
              @if (now()->isSameDay($mo->scheduled_date))
                Today
              @elseif (now()->isTomorrow($mo->scheduled_date))
                Tomorrow
              @elseif (now()->diffInDays($mo->scheduled_date, false) > 0)
                In {{ now()->diffInDays($mo->scheduled_date) }} days
              @elseif (now()->diffInDays($mo->scheduled_date, false) < 0)
                {{ now()->diffInDays($mo->scheduled_date) }} days ago
              @endif
            </td>
            <td>{{ $mo->product->product_name }}</td>
            <td>
              @php
                $isMaterialAvailable = true; // Logika Anda untuk mengecek ketersediaan material
              @endphp
              {{ $isMaterialAvailable ? 'Tersedia' : 'Belum Tersedia' }}
            </td>
            <td>{{ $mo->quantity }}</td>
            <td>
              <span
                class="badge
                {{ $mo->status == 'draft' ? 'badge-secondary' : '' }}
                {{ $mo->status == 'in_progress' ? 'badge-warning' : '' }}
                {{ $mo->status == 'completed' ? 'badge-success' : '' }}">
                {{ ucfirst($mo->status) }}
              </span>
            </td>
            <td>
              <a href="{{ route('mo.edit', $mo->id) }}" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{ route('mo.destroy', $mo->id) }}" method="POST" style="display: inline-block;"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center">Tidak ada data Manufacturing Order</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
