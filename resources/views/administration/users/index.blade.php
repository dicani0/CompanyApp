@extends('layouts.app')
@section('content')
@livewireStyles
    <div class="container">
        @if ($trashed)
            <h2>Trashed Users</h2>
        @else
            <h2>Users</h2>
        @endif
        <a href="{{ route('users.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i></a>
        <livewire:users-table :trashed="$trashed"/>
    </div>
    @livewireScripts
@endsection
