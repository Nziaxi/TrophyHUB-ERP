@extends('layouts.app')

@section('title', 'Tambah MO')

@section('content')
  <div class="container mt-5">
    <h1 class="mb-4">Tambah MO</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('mo.store') }}" method="POST" id="create-mo-form">
      @csrf

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="product_id">Produk</label>
            <select name="product_id" id="product_id" class="form-control" required>
              <option value="">Pilih Produk</option>
              @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="bom_id">Kode BoM</label>
            <select name="bom_id" id="bom_id" class="form-control" required>
              <option value="">Pilih Kode BoM</option>
              @foreach ($boms as $bom)
                <option value="{{ $bom->id }}">{{ $bom->bom_code }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Masukkan Quantity" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="dateline">Tanggal Akhir</label>
            <input type="date" name="dateline" id="dateline" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="planning_date">Tanggal Perencanaan</label>
            <input type="date" name="planning_date" id="planning_date" class="form-control" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="responsible_person">Penanggung Jawab</label>
            <input type="text" name="responsible_person" id="responsible_person" class="form-control" required>
          </div>
        </div>
      </div>

      <h5>Bahan</h5>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Komponen</th>
            <th>Yang Diperlukan</th>
          </tr>
        </thead>
        <tbody id="material-table-body">
          <!-- Baris bahan akan diisi berdasarkan pilihan BoM -->
        </tbody>
      </table>

      <button type="button" class="btn btn-info" id="load-materials-btn">Tampilkan Bahan</button>

      <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </form>
  </div>

  <script>
    const bomMaterials = @json($boms);

    document.getElementById('load-materials-btn').addEventListener('click', function() {
      const bomId = document.getElementById('bom_id').value;
      const quantity = parseFloat(document.getElementById('quantity').value) || 0;
      const materialTableBody = document.getElementById('material-table-body');

      materialTableBody.innerHTML = '';

      if (bomId) {
        const selectedBom = bomMaterials.find(bom => bom.id == bomId);

        if (selectedBom && selectedBom.components.length > 0) {
          selectedBom.components.forEach((component, index) => {
            const requiredQuantity = quantity * component.quantity;
            const row = `
              <tr>
                <td>${component.material.material_name}</td>
                <td><input type="number" name="materials[${index}][required]" class="form-control" value="${requiredQuantity}" readonly></td>
                <input type="hidden" name="materials[${index}][material_id]" value="${component.material_id}">
              </tr>
            `;
            materialTableBody.innerHTML += row;
          });
        } else {
          materialTableBody.innerHTML = `<tr><td colspan="2" class="text-center">Tidak ada bahan untuk Kode BoM ini.</td></tr>`;
        }
      } else {
        alert('Pilih Kode BoM terlebih dahulu.');
      }
    });

    document.getElementById('quantity').addEventListener('input', function() {
      document.getElementById('load-materials-btn').click();
    });
  </script>
@endsection
