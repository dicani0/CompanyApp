@extends('layouts.app')
@section('content')
<div class="container">
    {{ html()->modelForm($supplier, 'PUT', route('suppliers.update', $supplier->id))->acceptsFiles()->open() }}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {{ html()->label('Name')->for('name') }}
                {{ html()->text('name')->class('form-control') }}
            </div>
            <div class="form-group">
                {{ html()->label('Address')->for('address') }}
                {{ html()->text('address')->class('form-control') }}
            </div>
            <div class="form-group">
                {{ html()->label('User')->for('user_id') }}
                {{ html()->select('user_id', $users)->class('form-control') }}
            </div>
            <div class="form-group">
                {{ html()->label('Logo')->for('image') }}
                {{ html()->file('image')->class('form-control') }}
            </div> 
        </div>
        <div class="col-6">
            <div class="form-group">
                {{ html()->label('Description')->for('description') }}
                {{ html()->textarea('description')->class('form-control')->rows(6) }}
            </div>
            <img height="120px" class="d-block mx-auto" src="{{ asset('storage/' . $supplier->logo) }}" alt="">   
        </div>
    </div>
   <div class="text-center">
       {{ html()->submit('Update')->class('btn btn-success w-25') }}
       <a href="{{ route('suppliers.index') }}" class="btn btn-warning w-25">Cancel</a>
   </div>
    {{ html()->form()->close() }}
</div>
@endsection

@section('scripts')
    <script defer>
        $(document).ready(function() {
            $('.select-form').select2();
        });
    </script>
@endsection