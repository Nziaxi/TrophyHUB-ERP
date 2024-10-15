@extends('layouts.app')

@section('title')
    Tambah Produk
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Produk</a></li>
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
                    <!-- Form start -->
                    <div class="card card-primary" style="background-color: #273B70">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf  <!-- Token CSRF untuk keamanan -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Nama Produk -->
                                        <div class="form-group">
                                            <label for="product_name" style="color: #fff">Nama Produk</label>
                                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Nama Produk" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Kategori Produk -->
                                        <div class="form-group">
                                            <label for="category" style="color: #fff">Kategori Produk</label>
                                            <select name="category" class="form-control select" style="width: 100%;" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="Kayu">Kayu</option>
                                                <option value="Akrilik">Akrilik</option>
                                                <option value="Kuningan">Kuningan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Deskripsi Produk -->
                                        <div class="form-group">
                                            <label for="description" style="color: #fff">Deskripsi Produk</label>
                                            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Deskripsi Produk"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Gambar Produk -->
                                        <div class="form-group">
                                            <label for="product_image" style="color: #fff">Gambar Produk</label>
                                            <div class="border border-light" style="height: 200px; display: flex; justify-content: center; align-items: center; color: #fff;">
                                                Drag & Drop your file or <strong>Browse</strong>
                                            </div>
                                            <input type="file" name="product_image" class="form-control-file mt-2" id="product_image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Harga Jual -->
                                        <div class="form-group">
                                            <label for="selling_price" style="color: #fff">Harga Jual</label>
                                            <input type="number" name="selling_price" class="form-control" id="selling_price" placeholder="Harga Jual" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Harga Produksi -->
                                        <div class="form-group">
                                            <label for="production_cost" style="color: #fff">Harga Produksi</label>
                                            <input type="number" name="production_cost" class="form-control" id="production_cost" placeholder="Harga Produksi" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
