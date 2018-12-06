@extends('main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Contact</h1>
        <form action="">
            <div class="form-group">
                <label for="" name="email">Email</label>
                <input id="email" name="email" class="form-control" type="email">
            </div>
            <div class="form-group">
                    <label for="" name="subject">Subject</label>
                    <input id="subject" name="subject" class="form-control" type="text">
            </div>
            <div class="form-group">
                    <label for="" name="email">Email</label>
                    <textarea id="message" name="message" class="form-control">Type your message here...</textarea>
            </div>

            <input type="submit" class="btn btn-success" value="SEND">
        </form>                
    </div>
</div>
@endsection

@section('title', '| Contact')