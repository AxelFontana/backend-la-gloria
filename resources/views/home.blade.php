@extends('layouts.base')

@section('dropdown-tables')
<ul class="navbar-nav">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Tables
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
        <a class="dropdown-item" href="{{ route('brands.index') }}">Brands</a>
        <a class="dropdown-item" href="{{ route('products.index') }}">Products</a>
        <a class="dropdown-item" href="{{ route('clients.index') }}">Clients</a>
    </div>
    </li>
</ul>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
