<?php

namespace App\Http\Controllers;

use App\Models\Shipper;
use Illuminate\Http\Request;
use App\Http\Requests\ShipperRequest;

class ShipperController extends Controller
{
    public function index()
    {
        $data = Shipper::with('users')->get();
        return view('backend.shipper.index',['data' => $data]);
    }

    public function create()
    {
        return view('backend.shipper.create');
    }

    public function store(ShipperRequest $request)
    {
        try {
            $request->validated();
            Shipper::create([
                'name' => $request->name,
                'description' => $request->description,
                'code' => $request->code,
                'user_id' => auth()->user()->id,
                'status' => $request->status == false ? false : true
            ]);
            return redirect(route('shipper.index'))->with('added','data added successfully...!');
        } catch (Exception $ex) {
            return redirect(route('shipper.create'))->with('notAdded','data not added...!');
        }
    }

    public function edit($id)
    {
        $update = Shipper::findOrFail($id);
        return view('backend.shipper.edit',['update' => $update]);
    }

    public function update(ShipperRequest $request,$id)
    {
        $data = $request->validated();

        $check = Shipper::where('shipper_id',$id)->update([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'description' => $request->description,
            'code' => $request->code,
            'status' => $request->status == false ? false : true
        ]);
        if ($check) {
            return redirect(route('shipper.index'))->with('updated','data updated successfully...!');
        }else{
            return redirect(route('shipper.edit'))->with('notUpdated','data not updated...!');
        }
    }

    public function trash($id)
    {
        try {
            $check = Shipper::findOrFail($id);
            if ($check) {
                $check->delete();
                return redirect(route('shipper.index'))->with('deleted','data deleted successfully...!');
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }

    public function trashed(){
        $data = Shipper::with('users')->onlyTrashed()->get();
        return view('backend.shipper.trash',['data' => $data]);
    }

    public function restoreTrash($id){
        try {
            $check = Shipper::withTrashed()->findOrFail($id);
            if ($check) {
                $check->restore();
                return redirect(route('shipper.index'));
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }

    public function forceDeleted($id){
        try {
            $check = Shipper::withTrashed()->findOrFail($id);
            if ($check) {
                $check->forceDelete();
                return redirect(route('shipper.index'));
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }
}
