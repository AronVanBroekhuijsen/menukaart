@guest
@else
<nav class="nav navbar navbar-expand-md navbar-light bg-white shadow-sm text-red-400">

    <div class="px-3 w-100">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggle">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </ul>

            <!-- Middle Side Of Navbar -->
            <ul class="navbar-nav mx-auto custom-nav-links">
                <!-- Authentication Links -->
                @if (Auth::user()->role != 'user')
                    <a class="nav-link" href="{{ route('dish_view') }}">Producten</a>
                    <a class="nav-link" href="{{ route('category_view') }}">Categorien</a>
                    <a class="nav-link" href="{{ route('sauce_view') }}">Sauzen/Toppings</a>
                    <a class="nav-link" href="{{ route('side_view') }}">Bijgerechten</a>
                @endif
                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                    <a class="nav-link" href="{{ route('order_view') }}">Volgorde aanpassen</a>
                @endif
                @if (Auth::user()->role == 'admin')
                    <a class="nav-link" href="{{ route('user_view') }}">Gebruikers</a>
                    <a class="nav-link" href="{{ route('settings') }}">Instellingen</a>
                    <a class="nav-link" href="{{ route('label_view') }}">Feestdagen</a>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="mb-4rem"></div>
@endguest

