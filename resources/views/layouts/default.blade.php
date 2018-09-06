<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'blog')</title>
    <link rel="stylesheet" href="/css/app.css">

</head>
<body>
    @include('layouts._header')

    <div class="container">
        @include('shared._msg')
        @yield('content')
    </div>

    @include('layouts._footer')
</body>
</html>