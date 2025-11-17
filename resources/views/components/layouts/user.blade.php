<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <x-includes.admin.navbar />

    <div class="flex h-full w-full">
        <x-ui.success-error-topup />

        <div class="slot w-full h-full p-3">
            @yield('content')
        </div>

    </div>


    {{$script ?? ''}}
    @stack('script')

</body>
</html>