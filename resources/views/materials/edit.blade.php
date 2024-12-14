@extends('layouts.app')

@section('title')
  Edit Bahan
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  {{-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Bahan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Bahan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section> --}}

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary" style="background-color: #273B70">
            <!-- form start -->
            <form id="quickForm" action="{{ route('materials.update', $material->id) }}" method="POST">
              @csrf
              @method('put')
              <div class="card-body">
                <div class="form-group">
                  <label for="material_name" style="color: #fff">Nama Bahan</label>
                  <input type="text" name="material_name" class="form-control" id="material_name" placeholder="Nama Bahan"
                    value="{{ $material->material_name }}" required>
                </div>
                <div class="form-group">
                  <label for="unit" style="color: #fff">Satuan Bahan</label>
                  <select name="unit" class="form-control select" style="width: 100%;" required>
                    <option value="">Pilih Produk</option>
                    <option value="Kilometer" {{ old('type', $material->unit) == 'Kilometer' ? 'selected' : '' }}>Kilometer</option>
                    <option value="Centimeter" {{ old('type', $material->unit) == 'Centimeter' ? 'selected' : '' }}>Centimeter</option>
                    <option value="Kilogram" {{ old('type', $material->unit) == 'Kilogram' ? 'selected' : '' }}>Kilogram</option>
                    <option value="Gram" {{ old('type', $material->unit) == 'Gram' ? 'selected' : '' }}>Gram</option>
                    <option value="Lembar" {{ old('type', $material->unit) == 'Lembar' ? 'selected' : '' }}>Lembar</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="price" style="color: #fff">Harga Bahan</label>
                  <input type="number" name="price" class="form-control" id="price" value="{{ $material->price }}" required>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
