@extends('component')
@section('navbar')
<style>
    .navbar {
        background-color: #60b7ff
    }

    .active {
        font-weight: bolder
    }
</style>
<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <a class="navbar-brand" href="home"><img src="{{ asset('logo.png') }}" height="50px" class="ms-3"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mb-2 mb-md-0">
                <li class="nav-item" >
                    <a class="nav-link @yield('home') text-white" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('transaction') text-white" href="transaction">Transaction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('history') text-white" href="history">History</a>
                </li>
            </ul>
            <div class="dropdown offset-md-8">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                @if(session()->has('photo'))
                    <img src="{{ asset('storage/'.session('photo')) }}" alt="mdo" width="45" height="45" class="rounded-circle">
                @else
                    <img src="{{ asset('default.jpg') }}" alt="mdo" width="45" height="45" class="rounded-circle">
                @endif
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li><a class="dropdown-item" href="{{ url('profile') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@yield('home-page')
@yield('transaction-page')
@yield('history-page')

{{-- Profile --}}
@yield('profile')
@yield('edit-profile')
@yield('change-password')

@endsection