@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.components.progress', ['progress' => 40])
        <div class="d-flex mb-3">
            <h2 class="d-inline-block align-items-center">{{ $supplier->name }} Menu</h2>
            <a href="{{ route('catering') }}" class="btn btn-info align-self-center mx-2">Go back</a>
        </div>
        <div class="d-flex justify-content-between flex-wrap">
            @foreach ($supplier->dishes as $dish)
            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <a href="{{ route('cart.add', $dish) }}" class="card card-hover h-100 text-decoration-none text-white-50" data-toggle="tooltip" data-placement="top" title="Click to add to cart">
                    <div class="card-header">
                        <h3 class="card-title text-center">
                            {{ $dish->name }}
                            
                        </h3>
                    </div>
                    <div class="card-body">                        
                        <hr class="bg-secondary">
                        <p>
                            {{ $dish->description }}
                        </p>
                    </div>
                    <div class="card-footer text-right">
                        <small>{{ $dish->price }}zł</small>
                    </div>
                </a>
            </div>        
            @endforeach
        </div>
        
    </div>
@endsection