@extends('layouts.app')
@section('content')
    @livewireStyles
    <div class="container">
        <div class="d-flex mb-3">
            <h2 class="d-inline-block align-items-center">Fundings</h2>
            <a href="{{ route('administration-dashboard') }}" class="btn btn-dark align-self-center mx-2">Go back</a>
            <a href="{{ route('fundings.renew') }}" class="btn btn-dark align-self-center mx-2">Renew all <i class="fas fa-sync"></i></a>
        </div>
        
        <livewire:fundings-table/>
    </div>
    @livewireScripts
@endsection