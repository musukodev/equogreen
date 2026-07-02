<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Equogreen' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="m-0 p-0 font-inter bg-gray-50 text-slate-900 antialiased">
    <div class="flex min-h-screen w-full">
        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>
