<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Forwarder;
use Illuminate\Http\Request;
use App\Http\Requests\ForwarderRequest;
use App\Http\Requests\BankSubmitRequest;

class ForwarderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Forwarder::with('users')->get();
        return view('backend.forwarder.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        return view('backend.forwarder.create',['data' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForwarderRequest $request)
    {
        try {
            $request->validated();
            Forwarder::create([
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'status' => $request->status == false ? false : true
            ]);
            return redirect(route('forwarder.index'))->with('added','data added successfully...!');
        } catch (\Exception $ex) {
            return redirect(route('forwarder.create'))->with('notAdded','data not added...!');
        }
    }

    public function edit($id)
    {
        $update = Forwarder::findOrFail($id);
        return view('backend.forwarder.edit',['update' => $update]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(ForwarderRequest $request,$id)
    {
        $data = $request->validated();

        $check = Forwarder::where('fid',$id)->update([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'status' => $request->status == false ? false : true
        ]);
        if ($check) {
            return redirect(route('forwarder.index'))->with('updated','data updated successfully...!');
        }else{
            return redirect(route('forwarder.edit'))->with('notUpdated','data not updated...!');
        }
    }

    public function trash($id)
    {
        try {
            $check = Forwarder::findOrFail($id);
            if ($check) {
                $check->delete();
                return redirect(route('forwarder.index'))->with('deleted','data deleted successfully...!');
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }

    public function trashed(){
        $data = Forwarder::with('users')->onlyTrashed()->get();
        return view('backend.forwarder.trash',['data' => $data]);
    }

    public function restoreTrash($id){
        try {
            $check = Forwarder::withTrashed()->findOrFail($id);
            if ($check) {
                $check->restore();
                return redirect(route('forwarder.index'));
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }

    public function forceDeleted($id){
        try {
            $check = Forwarder::withTrashed()->findOrFail($id);
            if ($check) {
                $check->forceDelete();
                return redirect(route('forwarder.index'));
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }
}
