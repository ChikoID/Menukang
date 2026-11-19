<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title') -
        @endif{{ config('app.name', 'Menukang') }}
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="flex min-h-screen flex-col bg-neutral-secondary font-sans text-body antialiased">
    @include('partials.navbar')

    @hasSection('sidebar')
        @yield('sidebar')
    @endif

    <div class="flex flex-1 flex-col pt-16 {{ View::hasSection('sidebar') ? 'sm:ml-64' : '' }}">
        <main class="flex-1 p-4 sm:p-6">
            @include('partials.flash')
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>
