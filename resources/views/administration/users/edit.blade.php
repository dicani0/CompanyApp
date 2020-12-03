@extends('layouts.app')
@section('content')
<div class="container">
    {{ html()->modelForm($user, 'PUT', route('users.update', $user->id))->open() }}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {{ html()->label('Name')->for('name') }}
                {{ html()->text('name')->class('form-control') }}
            </div>
            <div class="form-group">
                {{ html()->label('Email')->for('email') }}
                {{ html()->text('email')->class('form-control') }}
            </div>
        </div>
        <div class="col-6">
            {{ html()->label('Roles')->for('roles') }}
            {{ html()->select('roles', $roles, $user->roles->pluck('id'))->multiple()->class('form-control select-form') }}
        </div>
    </div>
   <div class="text-center">
       {{ html()->submit('Send')->class('btn btn-success w-25') }}
   </div>
    {{ html()->form()->close() }}
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select-form').select2();
        });
    </script>
@endsection