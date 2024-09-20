<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<nav id="navbar" class="navbar -mx-3 flex flex-1 justify-end">
    <ul>
        <li><a class="active" href="index.html">Home</a></li>
        <li><a href="services.html" >Services</a></li>

        <li><a href="contact.html">Contact</a></li>

        <li class="dropdown">
            <a class="login-link" href="#">

                <i class="bi bi-person-fill" style="font-size: 1.5em;margin-right: 5px"></i>
                @auth()
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                @else
                    Login
                @endauth

                <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
                @auth

                    <li><a class="" href="#">Profile</a></li>
                    <li><a class="" wire:click="logout" href="#">Log Out</a></li>



                @else
                    <li><a  href="{{ route('Login') }}"
                            {{--                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
                        >Login</a></li>

                    @if (Route::has('register'))
                        <li><a  href="{{ route('Register') }}">Register</a></li>
                    @endif
                @endauth


            </ul>
        </li>






    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav>

{{--@auth
    <a class="text-primary" href="{{ url('/dashboard') }}">Dashboard</a>
@else
    <a class="text-primary" href="{{ route('Login') }}"
        --}}{{--                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}{{--
    >Log in</a>

    @if (Route::has('register'))
        <a class="text-primary" href="{{ route('register') }}">Register</a>
    @endif
@endauth--}}
