@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create User</h1>
    <div class="row justify-content-center">
        <div class="col-sm-8">
                <form action="{{route('users.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control"type="text" id="username" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" class="custom-select" name="role">
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password" id="password" name="password">
                            <input type="checkbox" name="auto-generate" value="auto-generate">Auto Generate Password
                        </div>
                        <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input class="form-control" type="password" id="confirm_pass" name="confirm_pass">
                            </div>
                        <button>Submit</button>
                    
                    </form>
        </div>
    </div>

</div>
@stop