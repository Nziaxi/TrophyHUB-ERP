@extends('layouts.app')

@section('title')
    Tambah BoM
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tambah BoM</h1>

        <form action="{{ route('bom.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_id">Produk</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="bom_code">Kode BoM</label>
                <input type="text" name="bom_code" id="bom_code" class="form-control" placeholder="Kode BoM" required>
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
                    <tr>
                        <td>
                            <input type="text" name="components[0][name]" class="form-control" placeholder="Nama Komponen" required>
                        </td>
                        <td>
                            <input type="number" name="components[0][quantity]" class="form-control" placeholder="Quantity" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-component" class="btn btn-link">Tambah Komponen</button>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>

    <script>
        let componentCount = 1;
        document.getElementById('add-component').addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <input type="text" name="components[${componentCount}][name]" class="form-control" placeholder="Nama Komponen" required>
                </td>
                <td>
                    <input type="number" name="components[${componentCount}][quantity]" class="form-control" placeholder="Quantity" required>
                </td>
            `;
            document.getElementById('bom-components').appendChild(newRow);
            componentCount++;
        });
    </script>
@endsection
