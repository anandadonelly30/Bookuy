{{-- file: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bookuy')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>[x-cloak]{display:none;}</style>
</head>
<body class="bg-gray-50 text-slate-900">
    <div class="min-h-screen">
        @yield('content')
    </div>
</body>
</html>
