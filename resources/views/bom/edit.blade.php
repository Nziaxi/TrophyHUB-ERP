@extends('layouts.app')

@section('title')
  Edit BoM
@endsection

@section('content')
  <div class="container mt-5">
    <h1 class="mb-4">Edit BoM</h1>

    <form action="{{ route('bom.update', $bom->id) }}" method="POST">
      @csrf
      @method('PUT') <!-- Menggunakan PUT untuk update -->

      <div class="form-group">
        <label for="product_id">Produk</label>
        <select name="product_id" id="product_id" class="form-control" required>
          <option value="">Pilih Produk</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ $bom->product_id == $product->id ? 'selected' : '' }}>
              {{ $product->product_name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="bom_code">Kode BoM</label>
        <input type="text" name="bom_code" id="bom_code" class="form-control" placeholder="Kode BoM" value="{{ old('bom_code', $bom->bom_code) }}"
          required>
      </div>

      <h5>Bahan</h5>
      <table class="table">
        <thead>
          <tr>
            <th>Komponen</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody id="bom-components">
          @foreach ($bom->components as $index => $component)
            <tr>
              <td>
                <select name="components[{{ $index }}][material_id]" class="form-control" required>
                  <option value="">Pilih Komponen</option>
                  @foreach ($materials as $material)
                    <option value="{{ $material->id }}" {{ $component->material_id == $material->id ? 'selected' : '' }}>
                      {{ $material->material_name }}
                    </option>
                  @endforeach
                </select>
              </td>
              <td>
                <input type="number" name="components[{{ $index }}][quantity]" class="form-control" placeholder="Quantity"
                  value="{{ old('components.' . $index . '.quantity', $component->quantity) }}" step="0.01" required>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <button type="button" id="add-component" class="btn btn-link">Tambah Komponen</button>

      <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </div>
    </form>
  </div>

  <script>
    let componentCount = {{ count($bom->components) }};
    document.getElementById('add-component').addEventListener('click', function() {
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
                <td>
                    <select name="components[${componentCount}][material_id]" class="form-control" required>
                        <option value="">Pilih Komponen</option>
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->material_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="components[${componentCount}][quantity]" class="form-control" placeholder="Quantity" step="0.01" required>
                </td>
            `;
      document.getElementById('bom-components').appendChild(newRow);
      componentCount++;
    });
  </script>
@endsection
