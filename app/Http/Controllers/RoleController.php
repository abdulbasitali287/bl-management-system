<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $data = Role::with('users')->get();
        // $roleView = view('backend.role.index',$data)->render();
        // view('view.name', $data);
        return view('backend.role.index',['data' => $data]);
        // return response()->json(["roleView" => $roleView]);
    }

    public function create(){
        return view('backend.role.create');
    }

    public function store(Request $request){
        $request->validate([
            'role_name' => 'required',
        ]);
        Role::create([
            'name' => $request->role_name,
            'guard_name' => !empty($request->guard_name) ? $request->guard_name : 'web',
            'status' => $request->status == true ? true : false,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['message' => 'Data stored successfully']);
    }

    public function edit($id){
        $updateRole = Role::findOrFail($id);
        return view('backend.role.edit',['update' => $updateRole]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'role_name' => 'required',
        ]);
        $check = Role::where('rid',$id)->update([
            'name' => $request->role_name,
            'guard_name' => !empty($request->guard_name) ? $request->guard_name : 'web',
            'user_id' => auth()->user()->id,
            'status' => $request->status == false ? false : true
        ]);
        if ($check) {
            return response()->json(['message' => 'Data updated successfully...!']);
        }
    }

    public function trash(Request $request,$id){
        if ($request->ajax()) {
            $record = Role::findOrFail($id);
            $record->delete();
            return response()->json(['message' => 'Record deleted successfully']);
        }
    }


    public function bulkDelete(Request $request){
        $ids = $request->input('ids');
        Role::whereIn('rid', $ids)->delete();
        return response()->json(['message' => 'Records deleted successfully']);
    }

}
