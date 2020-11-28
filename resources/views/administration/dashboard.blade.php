@extends('layouts.app')
@section('content')
    <div class="d-flex flex-wrap flex-row container">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="{{ route('users.index') }}">
                <div class="card-header">
                    <p class="h4">
                        Users
                    </p>
                </div>
                <div class="card-body">
                    <p>Manage users</p>
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="{{ route('users.trashed') }}">
                <div class="card-header">
                    <p class="h4">
                        Trashed Users
                    </p>
                </div>
                <div class="card-body">
                    <p>Restore or delete users</p>
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    <p class="h4">
                        Fundings
                    </p>
                </div>
                <div class="card-body">
                    <p>
                        Manage workers' fundings
                    </p>
                </div>
            </a>
        </div>          
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="{{ route('suppliers.index') }}">
                <div class="card-header">
                    <p class="h4">
                        Suppliers
                    </p>
                </div>
                <div class="card-body">
                    <p>Manage suppliers</p>
                </div>
            </a>
        </div>
    </div>
@endsection