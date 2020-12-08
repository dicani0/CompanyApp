<li class="nav-item dropdown d-flex align-items-center">
    <a id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-dark btn btn-warning dropdown-toggle">
        <i class="fas fa-shopping-cart">
            <div class="ml-1 badge badge-pill badge-success">
                {{ Auth::user()->getCart()->dishes->count() }}
            </div>
        </i>
    </a>    
    <div class="dropdown-menu dropdown-menu-right border border-success" aria-labelledby="cartDropdown">
        <ul class="list-group">
            @foreach (Auth::user()->getCart()->dishes as $dish)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $dish->name }}&nbsp;&nbsp;&nbsp;</span>
                    <span class="mr-5">x{{ $dish->pivot->amount }}pcs.</span>
                    <span class="ml-5">{{ $dish->pivot->amount * $dish->price }}zł</span>
                      <div class="float-right"></div>
                </li>    
            @endforeach
            <li class="list-group-item bg-info text-dark">
                <p class="m-0">Price: <strong class="float-right">{{ Auth::user()->getCart()->getPrice() }}zł</strong></p>
            </li>
            <li class="list-group-item">
                <div class="btn-group float-right">
                    @if (Auth::user()->getCart()->dishes->count() > 0)
                    <a href="{{ route('order.create', Auth::user()->getCart()->id) }}" class="btn btn-info">Order</a>
                    @endif
                    <a href="{{ route('cart.clear') }}" class="btn btn-success">Clear</a>
                </div>
            </li>
        </ul>
    </div>                
</li>