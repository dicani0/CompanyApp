@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-deck mb-5">
                <div class="card bg-success text-white border-warning">
                    <div class="card-header">
                        Catering
                    </div>
                    <div class="card-body">
                        Application to order food!
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('catering') }}" class="btn btn-dark">Go!</a>
                    </div>
                </div>
                <div class="card bg-info text-white border-secondary">
                    <div class="card-header">
                        Project manager
                    </div>
                    <div class="card-body">
                        Application to provide help with managing projects!
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-light">Go!</a>
                    </div>
                </div>
                <div class="card bg-dark text-white border-danger">
                    <div class="card-header">
                        Placeholder
                    </div>
                    <div class="card-body">
                        Description placeholder!
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-danger">Go!</a>
                    </div>
                </div>
            </div>
            <div class="card-deck">
                <div class="card bg-dark text-white border-danger">
                    <div class="card-header">
                        Placeholder
                    </div>
                    <div class="card-body">
                        Description placeholder!
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-danger">Go!</a>
                    </div>
                </div>
                <div class="card bg-dark text-white border-danger">
                    <div class="card-header">
                        Placeholder
                    </div>
                    <div class="card-body">
                        Description placeholder!
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-danger">Go!</a>
                    </div>
                </div>
                <div class="card bg-dark text-white border-danger">
                    <div class="card-header">
                        Placeholder
                    </div>
                    <div class="card-body">
                        Description placeholder!
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-danger">Go!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection