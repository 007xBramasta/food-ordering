<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Product</div>

                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_menu">Name</label>
                                <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Description</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga_menu">Price</label>
                                <input type="number" class="form-control" id="harga_menu" name="harga_menu" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="kategori_menu">Category</label>
                                <input type="text" class="form-control" id="kategori_menu" name="kategori_menu" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="gambar_menu">Image</label>
                                <input type="file" class="form-control-file" id="gambar_menu" name="gambar_menu">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
