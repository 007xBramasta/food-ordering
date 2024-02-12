@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Product</div>

                    <div class="card-body">
                        <form action="{{ route('products.edit', ['productId' => $productId]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="categories_id">Category</label>
                                <input type="text" class="form-control" id="categories_id" name="categories_id" value="{{ $product->categories_id }}" required>
                            </div>
                            <div class="form-group">
                                <label for="image_menu">Image</label>
                                <input type="file" class="form-control-file" id="image_menu" name="image_menu">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
