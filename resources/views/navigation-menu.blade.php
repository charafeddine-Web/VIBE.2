<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo - Facebook style logo (blue circle with 'f') -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}" class="transition-transform duration-300 transform hover:scale-110">
                        <div class="bg-blue-600 h-10 w-10 rounded-full flex items-center justify-center">
                            <span class="text-black font-bold text-2xl">VIBE</span>
                        </div>
                    </a>
                </div>

                <!-- Search Bar (Facebook style) -->
                <div class="ml-4 flex items-center">
                    <div class="relative">
                        <form method="get" action="{{ route('Search') }}" class="flex items-center bg-gray-100 rounded-full px-4 py-1 w-80 shadow-sm">
                            <i class="fas fa-search text-gray-500"></i>
                            <input type="text" name="query" value="{{ request('query') }}"
                                   autofocus autocomplete="query"
                                   class="bg-transparent flex-1 h-9 pl-2 text-sm focus:outline-none focus:border-none border-none"
                                   placeholder="Rechercher ...">
                        </form>
                    </div>
                </div>


                <!-- Navigation Links (preserved structure, styled like Facebook) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('dashboard')" class="text-gray-600 hover:text-blue-600 transition-all duration-200">
                        <i class="fas fa-home text-xl mr-2"></i> {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('afficherDemandesAmitie') }}" :active="request()->routeIs('afficherDemandesAmitie')" class="text-gray-600 hover:text-blue-600 transition-all duration-200">
                        <i class="fas fa-user-friends text-xl mr-2"></i> {{ __('demande') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('showallamis') }}" :active="request()->routeIs('showallamis')" class="text-gray-600 hover:text-blue-600 transition-all duration-200">
                        <i class="fas fa-users text-xl mr-2"></i> {{ __('List Amis') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Facebook style action buttons -->
                <div class="flex space-x-2 mr-2">
                    <!-- Icône Notification -->
                    <button class="p-2 bg-gray-200 rounded-full text-gray-700 hover:bg-gray-300 relative">
                        <i class="fas fa-bell text-lg"></i>
                        <!-- Badge de notification -->
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-4 h-4 flex items-center justify-center">
            3
        </span>
                    </button>

                    <button class="p-2 bg-gray-200 rounded-full text-gray-700 hover:bg-gray-300">
                        <i class="fa-brands fa-facebook-messenger text-xl"></i>
                    </button>

                </div>


                <!-- Settings Dropdown (preserved but styled) -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full transition focus:outline-none focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition duration-200 ease-in-out">
                                        {{ Auth::user()->name }}
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                <!-- Account Management (preserved structure) -->
                                <div class="block px-4 py-2 text-xs text-gray-600 bg-gray-50 rounded-t-md">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}" class="transition duration-150 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2 text-gray-500"></i> {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}" class="transition duration-150 hover:bg-gray-100">
                                        <i class="fas fa-key mr-2 text-gray-500"></i> {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication (preserved) -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" class="text-red-600 transition duration-150 hover:bg-red-50"
                                                     @click.prevent="$root.submit();">
                                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger (preserved but styled) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (preserved but styled like Facebook) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200 max-h-screen overflow-y-auto">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100">
                <i class="fas fa-home mr-2"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('afficherDemandesAmitie') }}" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100">
                <i class="fas fa-users mr-2"></i> {{ __('demande') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('showallamis') }}" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100">
                <i class="fas fa-users mr-2"></i> {{ __('List Amis') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options (preserved but styled) -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Account Management (preserved) -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100">
                    <i class="fas fa-user mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100">
                        <i class="fas fa-key mr-2"></i> {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication (preserved) -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" class="text-red-600 hover:text-red-700 hover:bg-red-50"
                                           @click.prevent="$root.submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

