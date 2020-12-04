@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.components.progress', ['progress' => 60])
        <div class="d-flex mb-3">
            <h2 class="d-inline-block align-items-center">Summary</h2>
            <a href="{{ route('catering') }}" class="btn btn-info align-self-center mx-2">Go back</a>
        </div>
        <div class="jumbotron">
            <h3>Order no. #{{ $order->id }}</h3>
            <div class="card">
                <div class="card-header">
                    <h3>Positions:</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($order->orderItems as $item)
                            <li class="list-group-item">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4>{{ $item->dish->name }} &nbsp; x{{ $item->amount }}</h4>
                                    <small>{{ $item->price * $item->amount}}zł</small>
                                </div>
                                <p class="text-white-50">{{ $item->dish->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <h4 class="float-right text-light">Price: {{ $order->getPrice() }}zł</h4>
                </div>
            </div>
        </div>
    </div>
@endsection