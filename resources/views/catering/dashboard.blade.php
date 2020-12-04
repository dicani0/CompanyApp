@extends('layouts.app')
@section('content')
<div class="container">
        @include('layouts.components.progress', ['progress' => 10])
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Catering App!</h1>
        <hr class="my-3">
        <p class="lead">Here you can choose dishes you wish to eat!</p>
    </div>

    <div class="d-flex flex-wrap flex-row">
        @foreach ($suppliers as $supplier)
        <div class="col-3">
            <a href="{{ route('dishes', $supplier->id) }}" class="d-flex flex-column justify-content-between align-items-start text-decoration-none p-2 border border-secondary blurred h-100">
                <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                    <h5 class="mb-1">{{ $supplier->name }}</h5>
                    <div class="badge badge-info"></div>
                </div>
                <p>{{ $supplier->description }}</p>
                <p><small>{{ $supplier->address }}</small></p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection