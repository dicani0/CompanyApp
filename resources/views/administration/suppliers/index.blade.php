@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center pb-3">
            <h3 class="m-0">Suppliers</h3>
            <div class="btn-group">
                <a href="{{ route('administration-dashboard') }}" class="btn btn-warning">Go back</a>
                <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add</a>
            </div>
        </div>
        <ul class="list-group">
            @foreach ($suppliers as $supplier)
                <li class="list-group-item border-secondary">
                    <strong>{{ $supplier->name }}</strong>
                    <small>{{ $supplier->address }}</small>
                    <div class="btn-group float-right">
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger"><i class="fas fa-minus-square"></i></a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection