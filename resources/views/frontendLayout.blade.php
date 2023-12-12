<!doctype html>
<html class="no-js" lang="zxx">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title') </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Include Styles -->
  @include('frontend/layouts/styles')
</head>

<body>
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

  <!-- Include Scripts -->
  @include('frontend/layouts/scripts')

</body>

</html>
