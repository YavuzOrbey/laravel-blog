<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    {{Html::style('css/style.css')}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheets')
    <style>
      #notifications{
        position: absolute;
        border: 1px solid red;
        border-radius: 50%;
        display: inline-block;
        width: 25px;
        height: 25px;
        position: absolute;
        color: white;
        background: red;
        text-align:center;
        font-size: 14px;
        vertical-align: 14px;
        right: -10px;
        overflow: hidden;
      }
    </style>
    <title>Yavuz Orbey @yield('title')</title> <!--title needs to change for different pages -->
  </head>