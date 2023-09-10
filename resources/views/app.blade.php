<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/scripts/main.ts')
        @routes
        @inertiaHead
    </head>
    <body class="font-poppins bg-gray-50 text-sm">
      @inertia
    </body>
</html>
