@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="mb-3">Suppliers</h3>
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