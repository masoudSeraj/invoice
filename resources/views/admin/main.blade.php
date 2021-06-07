<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>invoice</title>
    <link rel="stylesheet" href="{{ asset('admin/css/bundle.css') }}">
</head>
<body>
    @include('admin.layouts.header')
    @yield('content')
    @include('admin.layouts.footer')
</body>
</html>
