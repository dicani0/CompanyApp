@extends('layouts.app')
@section('content')
<div class="container">
        <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped bg-dark progress-bar-animated" role="progressbar" style="width: 95%;"
                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Catering App!</h1>
        <hr class="my-3">
        <p class="lead">Here you can choose dishes you wish to eat!</p>
    </div>

    <ul class="list-group">
        @foreach ($suppliers as $supplier)
        <a href="#" class="list-group-item d-flex flex-column justify-content-between align-items-start text-decoration-none blurred">
            <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                <h5 class="mb-1">{{ $supplier->name }}</h5>
                <div class="badge badge-info">10</div>
            </div>
            <p>{{ $supplier->description }}</p>
            <p><small>{{ $supplier->address }}</small></p>
        </a>
        @endforeach

    </ul>
    
</div>
@endsection