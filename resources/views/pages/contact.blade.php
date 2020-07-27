@extends('main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Contact</h1>

    <form action="{{route('send.email')}}" method="POST" id="contact-form">
            @csrf
            Undergoing Maintenance 

            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                    <label for="fullname" >Name:</label>
                    <input id="fullname" name="fullname" class="input-control" type="text" placeholder="Your name" autocomplete="off" value={{old('fullname')}}>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <label for="contact-email" >Email:</label>
                        <input id="contact-email" name="email" class="input-control" type="email" placeholder="Your email" value={{old('email')}}>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <label for="subject">Subject:</label>
                        <input id="subject" name="subject" class="input-control" type="text" placeholder="Subject" autocomplete="off" value={{old('subject')}}>
                    </div>
                </div>

            </div>
            
           
            
            <div class="form-group">
                <label for="message">Message</label>
                <div class="row">
                    <div class="col-md-8">
                    <textarea id="message" name="message" class="textarea-control" placeholder="Type your message here...">{{old('message')}}</textarea>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                <div class="row">
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-block btn-outline-dark" value="SEND">
                    </div>
                </div>
            </div>
            
        </form>                
    </div>
</div>
@endsection

@section('title', '| Contact')

@section('stylesheets')

@stop

@section('head_scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop