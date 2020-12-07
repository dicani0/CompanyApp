@extends('layouts.app')
@section('content')
<div class="container">
    @include('layouts.components.progress', ['progress' => 100, 'theme' => 'success'])
    <div class="jumbotron">
        <h1>Order sent</h1>
        <p class="lead">Your order has been send to chosen suppliers!</p>
        <div class="card">
            <ul class="list-group">
                @foreach ($order->orderItems as $item)
                    <li class="list-group-item d-flex align-items-center justify-content-between"><p class="font-weight-bold m-0">{{ $item->dish->name }}&nbsp; x{{ $item->amount }}</p><small>{{ $item->price * $item->amount }}zł</small></li>
                @endforeach
                <li class="list-group-item"><p class="m-0 float-right">{{ $order->getPrice() }}zł</p></li>
            </ul>
        </div>
    </div>
</div>
@endsection