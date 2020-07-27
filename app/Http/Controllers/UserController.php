<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\User;
use App\Role;

use Hash;
use Session;
use Validator;
class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('role:superadministrator|administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function apiIndex(){
        $users = User::all();
        dd($users);
        return $users;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:190', 
            'username' => 'required|max:190|unique:users,username',
            'email' =>'required|email|unique:users', 
            'password'=>'required', 
            'role'=>'required']);

        if($request->password && !(empty($request->password)) ){
            $password = $request->password;
        }else{
            $password = 'password';
        }
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        
        if($user->save()){
            $user->roles()->sync($request->role);
            Session::flash('success', 'User successfully created!');
            return redirect()->route('users.show', $user->id);
        }
        else{
            Session::flash('danger', 'An error occurred');
            return redirect()->route('users.create');
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $token = (Session::has('token')) ? Session::get('token')->plainTextToken : "";

        $user = User::with('roles')->findOrFail($id);
        return view('admin.users.show', compact('user', 'token'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $roles = Role::all();
        $user = is_string($user) ? User::with('roles')->findOrfail($user): $user;

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), 
        ['name'=>'max:190',
        'email' =>Rule::unique('users')->ignore($id), 
        'username' => ['required', 'max:190', Rule::unique('users', 'username')->ignore($id)],
        'password'=>Rule::requiredIf(!isset($request->auto))])->validate();
        //$validatedData = $request->validate(['name'=>'required|max:190', 'email' => ['required', 'email', Rule::unique('users')->ignore($id)], 'password'=>'required']);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = isset($request->auto) ? Hash::make("password"): Hash::make($request->password);
       /*  
        //DEPRECATED WITH LARAVEL SANCTUM
        $token = Str::random(60);
        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ]); */
        //$token = $user->createToken('api_token');


        if($user->save()){
            $user->roles()->sync($request->role);
            Session::flash('success', 'User successfully updated!');
            return redirect()->route('users.show', $user->id);
        }
        else{
            Session::flash('danger', 'An error occurred');
            return redirect()->route('users.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
