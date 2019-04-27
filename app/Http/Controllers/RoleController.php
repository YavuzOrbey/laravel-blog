<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Validator;
use Session;
class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:superadministrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles = Role::all();
       return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        ['name'=>'required|max:190|alphadash|unique:roles,name',
        'description'=>'sometimes|max:190',
        'display_name'=>'required|max:190'
        ])->validate();

        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        if($role->save()){
            $role->permissions()->sync($request->permissions);
            Session::flash('success', 'New role created!');
            return redirect()->route('roles.show', $role->id);
        }
        else{
            Session::flash('danger', 'An error occurred');
            return redirect()->route('roles.create');
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
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::with('permissions')->findOrfail($id);
        return view('admin.roles.edit', compact('role', 'permissions'));
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
        ['display_name'=>'required|max:190',
        'description'=>'sometimes|max:190',
        'permissions'=> 'required'
        ])->validate();
        
        $role = Role::findOrFail($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        if($role->save()){
            $role->permissions()->sync($request->permissions);
            return redirect()->route('roles.show', $role->id);
        }
        else{
            Session::flash('danger', 'An error occurred');
            return redirect()->route('roles.edit', $id);
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
