<!doctype html>
<html>
<head>
    @include('include.head')
</head>
<body>
@include('include.footer')
<div class="container">
    <div id="main" class="row">
        @yield('content')
    </div>
</div>
</body>
</html>
