@extends('main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Contact</h1>
        {!! Form::open(['route' => 'contact.store']) !!}
    
        {!! Form::close() !!}
@endsection

@section('title', '| Contact')