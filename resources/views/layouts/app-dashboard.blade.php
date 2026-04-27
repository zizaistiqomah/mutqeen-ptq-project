<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F5F7FA]">

    @include('layouts.navbar-dashboard')

    <main>
        {{ $slot }}
    </main>

</body>
</html>