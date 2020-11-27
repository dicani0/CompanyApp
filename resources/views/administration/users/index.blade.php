@extends('layouts.app')
@section('content')
@livewireStyles
    <div class="container">
        @if ($trashed)
        <div class="d-flex">
            <h2 class="d-inline-block align-items-center">Trashed Users</h2>
            <a href="{{ url()->previous() }}" class="btn btn-dark align-self-center mx-2">Go back</a>
        </div>
        @else
        <h2 class="d-inline-block align-items-center">Users</h2>
        <a href="{{ url()->previous() }}" class="btn btn-dark align-self-center mx-2">Go back</a>
        @endif
        <a href="{{ route('users.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i></a>
        <livewire:users-table :trashed="$trashed"/>
    </div>
    @livewireScripts
@endsection
