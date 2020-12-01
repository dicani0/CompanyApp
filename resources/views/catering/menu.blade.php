@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.components.progress', ['progress' => 25])
        <a href="{{ route('catering') }}" class="btn btn-primary">Back</a>
        @foreach ($dishes as $dish)
        <div class="card">
            <div class="card-body">
                {{ $dish->name }}
            </div>
        </div>
        @endforeach
    </div>
@endsection