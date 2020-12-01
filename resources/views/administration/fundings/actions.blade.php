<div class="btn-group">
        <a href="{{ route('fundings.renew.one', $user->id) }}" class="btn btn-info"><i class="fas fa-redo"></i></a>
        <a href="{{ route('fundings.clear', $user->id) }}" class="btn btn-danger"><i class="fas fa-ban"></i></a>
        <button type="button" class="btn btn-primary btn-sm" onclick="setDefaultFunding({{ $user->id }}, {{ $user->funding->amount }})" data-toggle="modal">
            Set default funding <i class="fas fa-cog"></i> 
        </button>
</div>