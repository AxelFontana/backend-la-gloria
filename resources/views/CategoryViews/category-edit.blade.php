@extends('layouts.edit-form')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            </div>
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want to save the changes?')" >Update Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-2" onclick="return confirm('Are you sure you want to leave this page? Any changes you made will be lost.');">Go back</a>

        </form>
    </div>
@endsection
