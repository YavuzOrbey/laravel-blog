@extends('layouts.admin')

@section('content')

@foreach(Auth::user()->roles as $key => $role)
{{$role}}
@endforeach

@stop