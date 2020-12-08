@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.components.progress', ['progress' => 70])
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
                                    <h4 class="font-weight-bold">{{ $item->dish->name }} &nbsp; x{{ $item->amount }} <span class="font-weight-lighter">({{ $item->dish->supplier->name }})</span></h4>
                                    <small>{{ $item->price * $item->amount}}zł</small>
                                </div>
                                <p class="text-white-50">{{ $item->dish->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        {{-- <a href="{{ route('order.finalize', $order) }}" class="btn btn-primary btn-lg {{ $order->getPrice() > Auth::user()->funding->amount ? 'disabled' : '' }}">Order <i class="fas fa-money-bill-wave"></i></a> --}}
                        <a href="{{ route('order.finalize', $order) }}" class="btn btn-primary btn-lg {{ $order->getPrice() > Auth::user()->funding->amount ? 'disabled' : '' }}">Order <i class="fas fa-money-bill-wave"></i></a>
                        <a href="{{ route('order.delete', $order) }}" class="btn btn-warning btn-lg">Cancel <i class="fas fa-ban"></i></a>
                    </div>
                    <div class="d-flex flex-column">
                        <h4 class="float-right text-light">Price: {{ $order->getPrice() }}zł</h4>
                        <small class="{{ $order->getPrice() < Auth::user()->funding->amount ? 'text-success' : 'text-warning' }}">Your current fundings {{ Auth::user()->funding->amount }}zł</small>
                        @if ($order->getPrice() > Auth::user()->funding->amount)
                        <a href="{{ route('payment.pay', $order->getPrice() - Auth::user()->funding->amount) }}" class="btn btn-secondary">Buy missing credits</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection