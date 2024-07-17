@extends('layouts.create-form')


@section('content')
    <div class="container">

        <h1>Create a new product</h1>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}" required>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" name="size" class="form-control" id="size" value="{{ old('size') }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ old('size') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="price">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control" value="{{ old('brand_id') }}" required>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" value="{{ old('category_id') }}" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want to create this product?')">Create Product</button>

            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2" onclick="return confirm('Are you sure you want to leave this page? Any changes you made will be lost.');">Go back</a>


        </form>
    </div>
@endsection
