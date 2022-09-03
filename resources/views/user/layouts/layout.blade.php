<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Wallpaper Store</title>
<meta name="description" content="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('user_assets/images/favicon.png')}}" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{asset('user_assets/css/plugins.css')}}">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="{{asset('user_assets/css/bootstrap.min.css')}}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{asset('user_assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('user_assets/css/responsive.css')}}">
</head>
<body class="tm-index belle home4-fullwidth">
<div id="pre-loader">
    <img src="{{asset('user_assets/images/loader.gif')}}" alt="Loading..." />
</div>
<div class="pageWrapper">

    @include('user.inc.header-2')
    
    @yield('content')

    @include('user.inc.footer')

    @yield("extra-scripts")

</div>
</body>

</html>