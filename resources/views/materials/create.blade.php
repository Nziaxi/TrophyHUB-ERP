@extends('layouts.app')

@section('title')
  Tambah Bahan
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
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
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary" style="background-color: #273B70">
            <!-- form start -->
            <form id="quickForm" action="{{ route('materials.store') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="material_name" style="color: #fff">Nama Bahan</label>
                  <input type="text" name="material_name" class="form-control" id="material_name" placeholder="Nama Bahan" required>
                </div>
                <div class="form-group">
                  <label for="unit" style="color: #fff">Satuan Bahan</label>
                  <select name="unit" class="form-control select" style="width: 100%;" required>
                    <option value="">Pilih Satuan</option>
                    <option value="Kilometer">Kilometer</option>
                    <option value="Centimeter">Centimeter</option>
                    <option value="Kilogram">Kilogram</option>
                    <option value="Gram">Gram</option>
                    <option value="Lembar">Lembar</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="price" style="color: #fff">Harga Bahan</label>
                  <input type="number" name="price" class="form-control" id="price" required>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
