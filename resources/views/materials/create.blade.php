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
                        <form id="quickForm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_name" style="color: #fff">Nama Bahan</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name"
                                        placeholder="Nama Produk">
                                </div>
                                <div class="form-group">
                                    <label for="category" style="color: #fff">Satuan Bahan</label>
                                    <select class="form-control select" style="width: 100%;">
                                        <option>Pilih Produk</option>
                                        <option>Kilometer</option>
                                        <option>Centimeter</option>
                                        <option>Kilogram</option>
                                        <option>Gram</option>
                                        <option>Lembar</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="selling_price" style="color: #fff">Harga Jual</label>
                                    <input type="number" name="selling_price" class="form-control" id="selling_price"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="production_cost" style="color: #fff">Harga Bahan</label>
                                    <input type="number" name="production_cost" class="form-control" id="production_cost"
                                        required>
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
