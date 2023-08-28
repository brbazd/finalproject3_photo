<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('photos.index') }}" class="flex items-center group transition">
                        <span class="text-gray-500 dark:text-gray-400 hidden md:inline-block group-hover:text-gray-400 dark:group-hover:text-white">FINAL</span>
                        <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-gray-500 dark:stroke-gray-400 group-hover:stroke-gray-400 dark:group-hover:stroke-white">
                        <path d="M3 4H8M3 11H9.76389M14.2361 11H21M21 7.2V16.8C21 17.9201 21 18.4802 20.782 18.908C20.5903 19.2843 20.2843 19.5903 19.908 19.782C19.4802 20 18.9201 20 17.8 20H6.2C5.0799 20 4.51984 20 4.09202 19.782C3.71569 19.5903 3.40973 19.2843 3.21799 18.908C3 18.4802 3 17.9201 3 16.8V10.2C3 9.0799 3 8.51984 3.21799 8.09202C3.40973 7.71569 3.71569 7.40973 4.09202 7.21799C4.51984 7 5.0799 7 6.2 7H7.67452C8.1637 7 8.40829 7 8.63846 6.94474C8.84254 6.89575 9.03763 6.81494 9.21657 6.70528C9.4184 6.5816 9.59135 6.40865 9.93726 6.06274L11.0627 4.93726C11.4086 4.59136 11.5816 4.4184 11.7834 4.29472C11.9624 4.18506 12.1575 4.10425 12.3615 4.05526C12.5917 4 12.8363 4 13.3255 4H17.8C18.9201 4 19.4802 4 19.908 4.21799C20.2843 4.40973 20.5903 4.71569 20.782 5.09202C21 5.51984 21 6.0799 21 7.2ZM15 13C15 14.6569 13.6569 16 12 16C10.3431 16 9 14.6569 9 13C9 11.3431 10.3431 10 12 10C13.6569 10 15 11.3431 15 13Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="text-gray-500 dark:text-gray-400 hidden md:inline-block group-hover:text-gray-400 dark:group-hover:text-white">PHOTO</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('photos.index')" :active="request()->routeIs('photos.index')">
                        {{ __('Explore') }}
                    </x-nav-link>
                    <x-nav-link :href="route('photos.feed')" :active="request()->routeIs('photos.feed')">
                        {{ __('Feed') }}
                    </x-nav-link>
                    <x-nav-link :href="route('photos.create')" :active="request()->routeIs('photos.create')">
                        {{ __('Upload') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('users.show',auth()->user()->id)">
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.photos')">
                            {{ __('My Photos') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.likes')">
                            {{ __('My Likes') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.follows')">
                            {{ __('My Follows') }}
                        </x-dropdown-link>

                        @if (auth()->user()->role->name === 'admin')
                        <x-dropdown-link :href="route('admin.index')">
                            {{ __('Admin Panel') }}
                        </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Settings') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('photos.index')" :active="request()->routeIs('photos.index')">
                {{ __('Explore') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('photos.feed')" :active="request()->routeIs('photos.feed')">
                {{ __('Feed') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('photos.create')" :active="request()->routeIs('photos.create')">
                {{ __('Upload') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('users.show',auth()->user()->id)">
                    {{ __('My Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.photos')">
                    {{ __('My Photos') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.likes')">
                    {{ __('My Likes') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.follows')">
                    {{ __('My Follows') }}
                </x-responsive-nav-link>

                @if (auth()->user()->role->name === 'admin')
                <x-responsive-nav-link :href="route('admin.index')">
                    {{ __('Admin Panel') }}
                </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
