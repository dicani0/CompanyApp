@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.components.progress', ['progress' => 60])
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
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <h4 class="float-right text-warning">Price: {{ $order->getPrice() }}zł</h4>
                </div>
            </div>
        </div>
    </div>
@endsection