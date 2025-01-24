{{-- <div>
    <!-- He who is contented is rich. - Laozi -->
</div> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex">
    <!-- Sidebar -->
    @include('moderator.components.private.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto bg-white-100">
        @yield('content')
    </div>
</body>
</html>
