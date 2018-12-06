
@extends('main')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Welcome to my blog!</h1>
    <p class="lead">Thanks for visiting</p>
    <hr class="my-4">
    <p>My thoughts</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a>
</div>



<div class="row">
  <div class="col-md-8">
    <div class="blog-post">
      <h3>Title</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolor reiciendis vero rem facere. Ex non id obcaecati ad in facere aliquam? Quibusdam libero a commodi, beatae repudiandae ipsam cumque!</p>
      <a class="btn btn-primary" href="">Read More</a>
    </div>
    <hr>
    <div class="blog-post">
        <h3>Title</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolor reiciendis vero rem facere. Ex non id obcaecati ad in facere aliquam? Quibusdam libero a commodi, beatae repudiandae ipsam cumque!</p>
        <a class="btn btn-primary" href="">Read More</a>
      </div>
      <hr>

      <div class="blog-post">
          <h3>Title</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolor reiciendis vero rem facere. Ex non id obcaecati ad in facere aliquam? Quibusdam libero a commodi, beatae repudiandae ipsam cumque!</p>
          <a class="btn btn-primary" href="">Read More</a>
        </div>

      <hr>
  </div>
  <div class="col-md-3 offset-md-1">sidebar</div>
</div>
@endsection
