<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GrooveGate</title>
        <link rel="icon" type="image/png" href="/images/heroLogo.png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-(--color-background) text-white m-0 p-0 w-full overflow-x-hidden">

        <x-landing.nav />
        <x-landing.hero />
        <x-landing.roles />
        <x-landing.events />
        <x-landing.why />
        <x-landing.how />
        <x-landing.footer />

    </body>
</html>
