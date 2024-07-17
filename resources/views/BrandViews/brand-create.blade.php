@extends('layouts.create-form')
@section('content')
    <div class ="container">

        <h1>Create a new brand</h1>

        <form method="POST" action="{{ route('brands.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want to create this brand?')">Create Brand</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary mt-2" onclick="return confirm('Are you sure you want to leave this page? Any changes you made will be lost.');">Go back</a>
        </form>
    </div>
@endsection
