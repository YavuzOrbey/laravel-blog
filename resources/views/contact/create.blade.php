@extends('main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Contact</h1>
        <form action="{{ route('contact.store') }}" method="POST">
    @csrf
</form>

@endsection

@section('title', '| Contact')