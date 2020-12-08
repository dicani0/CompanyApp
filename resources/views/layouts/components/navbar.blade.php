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
                        <div class="dropdown-item disabled bg-primary text-dark">Current fundings: {{ Auth::user()->funding->amount }}zł</div>
                        
                        <div class="dropdown-item dropleft dropdown-hover">
                            <div aria-haspopup="true" aria-expanded="false">
                                Add credits
                            </div>
                            <div class="dropdown-menu">
                                <a href="{{ route('payment.pay', 10) }}" class="dropdown-item">10zł</a>
                                <a href="{{ route('payment.pay', 20) }}" class="dropdown-item">20zł</a>
                                <a href="{{ route('payment.pay', 50) }}" class="dropdown-item">50zł</a>
                                <a href="{{ route('payment.pay', 100) }}" class="dropdown-item">100zł</a>
                                <a href="{{ route('payment.pay', 200) }}" class="dropdown-item">200zł</a>
                            </div>
                        </div>

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

                @if (Request::is(['catering', 'catering/*']))
                @include('layouts.components.cart')
                @endif

                @endguest
            </ul>
        </div>
    </div>
</nav>