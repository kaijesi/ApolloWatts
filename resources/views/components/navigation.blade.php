{{-- Navigation Bar Component --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        {{-- Button to show on smaller screens --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                {{-- Only show navigation to household and installations for authenticated users --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my-household') }}">My Household</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my-installations') }}">My Installations</a>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav">
                {{-- Only show options for login and signup to non-authenticated users --}}
                @guest
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#login">
                            Login
                        </button>
                        <x-modal modalId="login" modalTitle="Login">
                            <x-login-form/>
                        </x-modal>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary m-2" href="{{ route('signup') }}">Sign Up</a>
                    </li>
                {{-- For authenticated users, show the My Details and logout options --}}
                @else
                <li class="nav-item">
                    <a class="btn btn-outline-primary m-2" href="{{ route('my-details') }}">My Details</a>
                </li>    
                <li class="nav-item">
                        <button type="submit" class="btn btn-primary m-2" form="logout-form">Logout</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>