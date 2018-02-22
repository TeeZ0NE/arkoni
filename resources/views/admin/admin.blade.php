<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    {{-- showing errors and messages --}}
    <div class="row my-auto">
      @if (Session::has("msg"))
      @component('layouts.parts.components.alert',
        ["alert_class"=>"success",
        "alert_text"=>Session::get("msg")])
        @endcomponent
        @endif

        @isset($sort) @php $sort or 'acs'@endphp @endisset

        @if($errors->any())
        @component('layouts.parts.components.alert',
          ["alert_class"=>"warning",
          "alert_text"=>$errors->first()])
          @endcomponent
          @endif
        </div>

        @section('admin_main_content')@show
        <div class="row">@include('admin.parts.footer')</div>
      </div>
    </body>
    </html>
