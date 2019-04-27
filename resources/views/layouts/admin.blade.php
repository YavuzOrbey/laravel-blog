<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yavuz Orbey - Admin Panel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
@include('inc._head')
  <body>
    @include('inc._nav')
    @include('inc._admin')
    <div class="container white mt-3 p-4 shadow">
      @include('inc._messages')
      @yield('content')
      <hr>
      <p class="text-center">Yavuz Orbey - Copyright {{ date('Y')}}</p>
    </div>
@include('inc._foot')