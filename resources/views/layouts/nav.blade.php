<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm col-12 py-4">
            <div class="container">

                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'HOME') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNavbar"
                    aria-controls="headerNavbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="headerNavbar">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-auto text-center">
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="{{ route('men.index')}}">MEN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">WOMEN</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-center">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('text.Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('text.Register') }}</a>
                        </li>
                        @endif
                        @else

                        <li class="nav-item dropdown mr-3">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('viewAny', App\Product::class)
                                <a class="dropdown-item" href="{{ route('administrators.index') }}">
                                    管理網站
                                </a>
                                @endcan

                                {{-- show order list --}}
                                <a class="dropdown-item" href="{{ route('orders.index') }}">查詢訂單</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('text.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        <nav-purchase-cart
                            route="{{ route('purchase_cart.show', ['purchase_cart' => auth()->user()->id]) }}"
                            purchase_list="{{ route('purchase_list', ['user_id' => auth()->user()->id]) }}">
                        </nav-purchase-cart>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>