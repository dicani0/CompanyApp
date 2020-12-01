@extends('layouts.app')
@section('content')
@livewireStyles
    <div class="container">
        @if ($trashed)
        <h2 class="d-inline-block align-items-center mb-5">Trashed Users</h2>
        <a href="{{ url()->previous() }}" class="btn btn-dark align-self-center mx-2">Go back</a>
        @else
        <h2 class="d-inline-block align-items-center mb-5">Users</h2>
        <a href="{{ url()->previous() }}" class="btn btn-dark align-self-center mx-2">Go back</a>
        @endif
        <livewire:users-table :trashed="$trashed"/>
    </div>
    @livewireScripts
@endsection
