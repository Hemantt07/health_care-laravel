<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/"><span class="text-primary">Health</span>-Care</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupport">

          <ul class="navbar-nav ml-auto justify-content-around w-100">

            <li class="nav-item @if(Request::url() == url('').'/home' OR Request::url() == url('')) active @endif">
              <a class="nav-link" href="/">Home</a>
            </li>

            <li class="nav-item @if(Request::url() === url('').'/about' ) active @endif">
              <a class="nav-link" href="{{ route('about-page') }}">About Us</a>
            </li>

            <li class="nav-item @if(Request::url() === url('').'/doctors' ) active @endif">
              <a class="nav-link" href="{{ route('doctors') }}">Doctors</a>
            </li>

            <li class="nav-item @if(Request::url() === url('').'/calender' ) active @endif">
              <a class="nav-link" href="#">Find Hospitals</a>
            </li>

            <li class="nav-item @if(Request::url() === url('').'/make-appointment' ) active @endif">
              <a class="nav-link" href="{{ route('make-appointment') }}">Make an appointment</a>
            </li>

            @if (Route::has('login'))
                @auth
            
            <li class="nav-item @if(Request::url() === url('').'/my-appointments' ) active @endif">
                <a class="nav-link" href="{{ route('my-appointments') }}">My appointments</a>
            </li>

            <div class="hidden sm:block d-flex border rounded">
                <div class="hidden sm:flex sm:items-center">
                    <!-- Settings Dropdown -->
                    <div class="relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text- focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 leading-4 rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>
            </div>

            @else
            <li class="nav-item">
                <a class="btn btn-primary ml-lg-3 mx-2" href="{{ route('login') }}">Login</a>
            </li>

                @if (Route::has('register'))

            <li class="nav-item">
                <a class="btn btn-primary ml-lg-3 mx-2" href="{{ route('register') }}">Register</a>
            </li>
            
                @endif
                @endauth  
            @endif    
          </ul>

        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
