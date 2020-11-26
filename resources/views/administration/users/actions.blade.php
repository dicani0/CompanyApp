<div class="btn-group">
    @if (!$user->isVerified())
        <a href="{{ route('users.verify', $user) }}" class="btn btn-info"><i class="fas fa-check-square"></i></a>
    @endif

    
    @if (!$trashed && Auth::user()->id !== $user->id)
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><i class="fas fa-pen-square"></i></a>
        
        {{ html()->modelForm($user, 'DELETE', route('users.destroy', $user->id))->open() }}
        {{ html()->submit()->class('btn btn-danger')->child(html()->span()->class('fas fa-minus-square')) }}
        {{ html()->form()->close()}}
    @elseif($trashed)
        <a href="{{ route('users.restore', $user->id) }}" class="btn btn-success"><i class="fas fa-trash-restore"></i></a>

        {{ html()->modelForm($user, 'DELETE', route('users.force-delete', $user->id))->open() }}
        {{ html()->submit()->class('btn btn-danger')->child(html()->span()->class('fab fa-accessible-icon')) }}
        {{ html()->form()->close()}}
    @endif
</div>