<nav
    x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
    class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
        <div class="flex">
            <div class="flex flex-shrink-0 items-center">
                <a href="{{ route('home') }}">
                    <h2 class="font-bold text-2xl">Barta</h2>
                </a>
            </div>
        </div>

        @auth
            <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
                <!-- Profile dropdown -->
                <div
                class="relative ml-3"
                x-data="{ open: false }">
                    <div>
                        <button
                        @click="open = !open"
                        type="button"
                        class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        id="user-menu-button"
                        aria-expanded="false"
                        aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img
                            class="h-8 w-8 rounded-full"
                            src="https://avatars.githubusercontent.com/u/831997"
                            alt="Ahmed Shamim Hasan Shaon" />
                        </button>
                    </div>
                
                    <!-- Dropdown menu -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1">
                        <a
                        href="{{ route('profile') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-0"
                        >Your Profile</a
                        >
                        <a
                        href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-1"
                        >Edit Profile</a
                        >
                        <div 
                            class="block px-4 py-2 hover:bg-gray-100"
                            role="menuitem"
                            tabindex="-1"
                            id="user-menu-item-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-800 text-sm">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                    </li>
                    <li>
                    <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                    </li>
                </ul>
            </div>
        @endguest

        <div class="-mr-2 flex items-center sm:hidden">
            <!-- Mobile menu button -->
            <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            type="button"
            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
            aria-controls="mobile-menu"
            aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!-- Icon when menu is closed -->
            <svg
                x-show="!mobileMenuOpen"
                class="block h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

            <!-- Icon when menu is open -->
            <svg
                x-show="mobileMenuOpen"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div
        x-show="mobileMenuOpen"
        class="sm:hidden"
        id="mobile-menu">
        
        <div class="border-t border-gray-200 lg:pt-4 lg:pb-3">
            @auth
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                    <img
                        class="h-10 w-10 rounded-full"
                        src="https://avatars.githubusercontent.com/u/831997"
                        alt="Ahmed Shamim Hasan Shaon" />
                    </div>
                    <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">
                        {{ auth()->user()->firstName . ' ' . auth()->user()->lastName }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        {{ auth()->user()->email }}
                    </div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a
                    href="{{ route('profile') }}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
                    >Your Profile</a
                    >
                    <a
                    href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
                    >Edit Profile</a
                    >
                    <div class="block px-4 py-2 hover:bg-gray-100"
                    >
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-800 text-base font-medium">Sign out</button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div>
                    <ul class="font-medium flex flex-col p-4 md:p-0 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                        <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                        </li>
                        <li>
                        <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</nav>