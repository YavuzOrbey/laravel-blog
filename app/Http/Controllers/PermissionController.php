<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Permission;
use Validator;
class PermissionController extends Controller
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
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
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
        ['name'=>'required|max:190|alphadash|unique:permissions,name',
        'description'=>'sometimes|max:190',
        'display_name'=>'required|max:190'
        ])->validate();
        
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        if($permission->save()){
            return redirect()->route('permissions.show', $permission->id);
        }
        else{
            Session::flash('danger', 'An error occurred');
            return redirect()->route('permissions.create');
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
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrfail($id);
        return view('admin.permissions.edit', compact('permission'));
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
        'description'=>'required|max:190'])->validate();
        
        $permission = Permission::findOrFail($id);
        $permission->display_name = $request->name;
        $permission->description = $request->description;
        if($permission->save()){
            return redirect()->route('permissions.show', $permission->id);
        }
        else{
            Session::flash('danger', 'An error occurred');
            return redirect()->route('permissions.edit', $id);
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
