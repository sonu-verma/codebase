<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Redirect;

use App\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $roles = Role::all();
        return view('roles.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:roles,name,'.$request->input('name'),
            'dname' => 'required|string|max:255|unique:roles,display_name,'.$request->input('dname'),
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect('admin/roles/add')->withInput()->withErrors($validator);
        }else{

            try{
                $data = $request->input();
                $roles = new Role;
                $roles->name = $data['name'];
                $roles->display_name = $data['dname'];
                $roles->status = $data['status'];
                $roles->save();
                return redirect('admin/roles/add')->with('status','successfully inserted.');
            }catch(Exception $e){
                return redirect('admin/roles/add')->with('failed','operation failed');
            }
            
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roleData = Role::find($id);
        return view('roles.update',compact('roleData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('role_id');
        $rules = [
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$id.',id'
            ],
            'dname' => [
                'required',
                'string',
                'unique:roles,display_name,'.$id.',id'
            ],
            'status' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
           return redirect()->back()->withInput()->withErrors($validator);
        }else{
            try{
                $roles = Roles::find($id);
                $roles->name = $request->input('name');
                $roles->display_name = $request->input('dname');
                $roles->status = $request->input('status');
                $roles->save();
                return redirect('admin/roles')->with('status','Succssully role updated');
            }catch(Exception $e){
                return redirect()-back()->with('errors','Operation failed');
            }
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
        $role = Role::find($id);
        $role->delete();

        return redirect('admin/roles')->with('status','Succesffully deleted.');
    }
}
