@extends('layouts.app')
@section('content')
    <div class="container">
        {{ html()->form('POST', route('dishes.store', $supplier))->acceptsFiles()->open() }}
        {{ html()->hidden('supplier_id')->value($supplier->id) }}
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {{ html()->label('Name')->for('name') }}
                    {{ html()->text('name')->class('form-control') }}
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {{ html()->label('Price[PLN]')->for('price') }}
                            {{ html()->number('price')->class('form-control') }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{ html()->label('Special Price[PLN]')->for('special_price') }}
                            {{ html()->number('special_price')->class('form-control') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ html()->label('Image')->for('image') }}
                    {{ html()->file('image')->class('form-control') }}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    {{ html()->label('Description')->for('description') }}
                    {{ html()->textarea('description')->class('form-control')->rows(8) }}
                </div>
            </div>
        </div>
        <div class="text-center">
            {{ html()->submit('Add')->class('btn btn-success w-25') }}
            <a href="{{ route('dishes', $supplier) }}" class="btn btn-warning w-25">Cancel</a>
        </div>
        {{ html()->form()->close() }}
    </div>
@endsection