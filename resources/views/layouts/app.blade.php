<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased relative">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-3 px-3 sm:py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="pb-8">
                {{ $slot }}
            </main>
        </div>
        <div class="w-full absolute bottom-0 text-xs md:text-sm">
            <div class="w-full border-gray-100 border-y bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="max-w-7xl mx-auto flex justify-evenly text-gray-500 dark:text-gray-400 py-2">
                    <a href="#">Help</a>
                    <a href="#">Terms of Use</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">About us</a>
                </div>
            </div>
            <div class="w-full bg-white dark:bg-gray-800">
                <div class="text-center py-2 text-gray-500 dark:text-gray-400">&copy; 2023</div>
            </div>
        </div>
    </body>
</html>
