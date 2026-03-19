<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-foreground ">
    <x-layout.nav />

    <main class="max-w-7xl mx-auto px-6 py-10">
        {{ $slot }}
    </main>
</body>
</html>
