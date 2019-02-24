@extends('main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Contact</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            </div>
            @endif
    <form action="{{route('send.email')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="contact-email" >Email</label>
                <input id="contact-email" name="email" class="form-control" type="email">
            </div>
            <div class="form-group">
                    <label for="fullname" >Name</label>
                    <input id="fullname" name="fullname" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input id="subject" name="subject" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control" placeholder="Type your message here..."></textarea>
            </div>

            <input type="submit" class="btn btn-success" value="SEND">
        </form>                
    </div>
</div>
@endsection

@section('title', '| Contact')