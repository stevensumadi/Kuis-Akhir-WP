<nav class="navbar navbar-expand-lg px-5 py-3 fixed-top" id="navbar" style="background-color: cornflowerblue">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-white" href="/">SKY UNIVERSE Lt.</a>
        <ul class="navbar-nav ms-auto">
            @auth
            <li class="nav-item dropdown d-flex">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome, {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu p-2" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->isAdmin == 1)
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/admin">
                                <i class="bi bi-grid-fill"></i><span class="ms-2">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i><span class="ms-2">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
                <a class="nav-item d-flex flex-row nav-link" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right text-white"></i>
                    <span class="ms-2 text-white">Login</span>
                </a>
            @endauth
        </ul>
    </div>
</nav>

<style>
    .dropdown-item:focus, .dropdown-item:hover {
        border-radius: 10px;
        background-color: cornflowerblue;
    }
</style>