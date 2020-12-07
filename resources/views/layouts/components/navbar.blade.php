<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                
                @if (Auth::user()->isAdmin())
                   <li class="nav-item">
                    <a class="nav-link text-dark btn btn-primary" href="{{ route('administration-dashboard') }}">Administration <i class="fas fa-hammer"></i></a>
                </li> 

                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('order.history') }}" class="dropdown-item">Orders history</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                <li class="nav-item dropdown d-flex align-items-center">
                    <a id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-dark btn btn-warning dropdown-toggle">
                        <i class="fas fa-shopping-cart">
                            <div class="ml-1 badge badge-pill badge-success">
                                {{ Auth::user()->getCart()->dishes->count() }}
                            </div>
                        </i>
                    </a>    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cartDropdown">
                        <ul class="list-group border border-warning">
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

                @endguest
            </ul>
        </div>
    </div>
</nav>