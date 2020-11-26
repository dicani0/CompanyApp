@extends('layouts.app')
@section('content')
    <div class="d-flex flex-wrap flex-row">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="{{ route('users.index') }}">
                <div class="card-header">
                    Users
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    Roles
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="{{ route('users.trashed') }}">
                <div class="card-header">
                    Trashed Users
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    Fundings
                </div>
            </a>
        </div>          
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    Suppliers
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    Order states
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">            
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    Dishes
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center">
            <a class="card bg-info text-light text-decoration-none" href="#">
                <div class="card-header">
                    Dish state
                </div>
            </a>
        </div>
    </div>
@endsection