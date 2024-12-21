@extends('layouts.app')

@section('title', 'Edit MO')

@section('content')
  <div class="container mt-5">
    <h1 class="mb-4">Edit MO</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('mo.update', $mo->id) }}" method="POST" id="edit-mo-form">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="product_id">Produk</label>
            <select name="product_id" id="product_id" class="form-control" required>
              <option value="">Pilih Produk</option>
              @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $mo->product_id == $product->id ? 'selected' : '' }}>
                  {{ $product->product_name }}
                </option>
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
                <option value="{{ $bom->id }}" {{ $mo->bom_id == $bom->id ? 'selected' : '' }}>
                  {{ $bom->bom_code }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $mo->quantity }}" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="dateline">Tanggal Akhir</label>
            <input type="date" name="dateline" id="dateline" class="form-control" value="{{ $mo->dateline }}" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="planning_date">Tanggal Perencanaan</label>
            <input type="date" name="planning_date" id="planning_date" class="form-control" value="{{ $mo->planning_date }}" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="responsible_person">Penanggung Jawab</label>
            <input type="text" name="responsible_person" id="responsible_person" class="form-control" value="{{ $mo->responsible_person }}"
              required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="status">Status Produksi</label>
        <select name="status" id="status" class="form-control">
          <option value="draft" {{ $mo->status == 'draft' ? 'selected' : '' }}>Draft</option>
          <option value="in_progress" {{ $mo->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
          <option value="completed" {{ $mo->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
      </div>

      <h5>Bahan</h5>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Komponen</th>
            <th>Yang Diperlukan</th>
            <th>Yang Dipesan</th>
            <th>Yang Digunakan</th>
            <th>Ketersediaan</th>
          </tr>
        </thead>
        <tbody id="material-table-body">
          @foreach ($mo->materials as $index => $material)
            <tr>
              <td>{{ $material->material_name }}</td>
              <td><input type="number" name="materials[{{ $index }}][required]" class="form-control"
                  value="{{ $material->pivot->required_quantity }}" readonly></td>
              <td><input type="number" name="materials[{{ $index }}][ordered]" class="form-control"
                  value="{{ $material->pivot->ordered_quantity ?? 0 }}" step="0.01"></td>
              <td><input type="number" name="materials[{{ $index }}][used]" class="form-control"
                  value="{{ $material->pivot->used_quantity ?? 0 }}" step="0.01"></td>
              <td><input type="text" class="form-control" value="Tersedia" readonly></td>
              <input type="hidden" name="materials[{{ $index }}][material_id]" value="{{ $material->id }}">
            </tr>
          @endforeach
        </tbody>
      </table>
      <button type="button" class="btn btn-info" id="load-materials-btn">Periksa Ketersediaan Bahan</button>
      <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                <td><input type="number" name="materials[${index}][ordered]" class="form-control" value="${requiredQuantity}" step="0.01"></td>
                <td><input type="number" name="materials[${index}][used]" class="form-control" value="0" step="0.01"></td>
                <td><input type="text" class="form-control" value="Tersedia" readonly></td>
                <input type="hidden" name="materials[${index}][material_id]" value="${component.material_id}">
              </tr>
            `;
            materialTableBody.innerHTML += row;
          });
        } else {
          materialTableBody.innerHTML = `<tr><td colspan="5" class="text-center">Tidak ada bahan untuk Kode BoM ini.</td></tr>`;
        }
      } else {
        alert('Pilih Kode BoM terlebih dahulu.');
      }
    });
  </script>
@endsection
