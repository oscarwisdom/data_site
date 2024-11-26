<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataPlug</title>
    <link rel="stylesheet" href={{ asset('assset/fontawesome-free-6.5.2-web/css/all.css') }}>

    <!-- ===================================our style sheet ============================== -->
     <link rel="stylesheet" href="dashboard.css">

     
</head>
<body>
    <div id="app">

        <main class="py-4">
            @include('includes.user-nav')

            @yield('content')
        </main>
    </div>


    <script src="dashboard.js"></script>
    <!-- <script src="pre-loader.js"></script> -->
     <script src="profile.js"></script>
     
</body>
</html>