<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> --}}
  </script>
  <script src="{{ mix('js/app.js') }}"></script>
  <style type="text/css" href="{{ mix('css/app.css') }}"></style> 
  {{-- styles --}}
  @include('admin.parts.components.styles')
</head>
<body>
  <div class="container">
    <p class="row my-auto p-2 alert alert-dark">Панель <strong>Адміністратора!</strong><i class="fab fa-accusoft"></i></p>
    <div class="row">@include('admin.parts.components.main_nav')</div>
    @section('admin_main_content')@show
    <div class="row">@include('admin.parts.footer')</div>
  </div>
</body>
</html>

