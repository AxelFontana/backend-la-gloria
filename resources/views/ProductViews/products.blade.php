@extends('home')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="ml-2">Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary mr-2">Create new product</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Manage</th>
                    <th>Enable</th>
                    <th>Manage Stock</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->size }}</td>
                        <td>{{ $product->image }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('products.set-enable', $product) }}"
                                onsubmit="return confirm('Are you sure you want to save this change?')">
                                @csrf
                                @method('PUT')
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="toggle-switch" name="switch-state" {{ $product->enable ? 'checked' : '' }}>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('products.edit-stock', $product) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <input type="text" name="stock" class="form-control" placeholder="Stock to add/remove" required oninvalid="this.setCustomValidity('Only numbers are allowed')" oninput="this.setCustomValidity('')" pattern="-?[0-9]*">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Apply Stock</button>
                                    </div>
                                </div>
                                @error($product->id)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$products->onEachSide(1)->links()}}
        </div>
    </div>
@endsection
