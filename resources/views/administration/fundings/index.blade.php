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

    <div class="modal" id="fundingsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Set default funding amount</h5>
                    <button type="button" onclick="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ html()->form('PUT')->id('fundingForm')->open() }}
                <div class="modal-body">
                        {{ html()->label('Amount [PLN]')->for('amount') }}
                        {{ html()->text('amount')->class('form-control')->id('fundingAmountInput') }}          
                </div>
                <div class="modal-footer">
                    {{ html()->submit('Save')->class('btn btn-success') }}
                    <button type="button" onclick="closeModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function setDefaultFunding(id, amount){
            const form = $('#fundingForm')[0];
            form.action = '/administration/fundings/' + id;
            let amountInput = $('#fundingAmountInput');
            amountInput.val(amount);
            $('#fundingsModal').show();
        }

        function closeModal(){
            $('#fundingsModal').hide();
        }
    </script>
@endsection