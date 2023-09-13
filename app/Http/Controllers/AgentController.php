<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;

class AgentController extends Controller
{
    
    public function index()
    {
        $data = Agent::with('users')->get();
        return view('backend.agent.index',['data' => $data]);
    }

    public function create()
    {
        return view('backend.agent.create');
    }

    public function store(AgentRequest $request)
    {
        try {
            $request->validated();
            Agent::create([
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'status' => $request->status == false ? false : true
            ]);
            return redirect(route('agent.index'))->with('added','data added successfully...!');
        } catch (Exception $ex) {
            return redirect(route('agent.create'))->with('notAdded','data not added...!');
        }
    }

    public function edit($id)
    {
        $update = Agent::findOrFail($id);
        return view('backend.agent.edit',['update' => $update]);
    }

    public function update(AgentRequest $request,$id)
    {
        $data = $request->validated();

        $check = Agent::where('aid',$id)->update([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'status' => $request->status == false ? false : true
        ]);
        if ($check) {
            return redirect(route('agent.index'))->with('updated','data updated successfully...!');
        }else{
            return redirect(route('agent.edit'))->with('notUpdated','data not updated...!');
        }
    }

    public function trash($id)
    {
        try {
            $check = Agent::findOrFail($id);
            if ($check) {
                $check->delete();
                return redirect(route('agent.index'))->with('deleted','data deleted successfully...!');
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }

    public function trashed(){
        $data = Agent::with('users')->onlyTrashed()->get();
        return view('backend.agent.trash',['data' => $data]);
    }

    public function restoreTrash($id){
        try {
            $check = Agent::withTrashed()->findOrFail($id);
            if ($check) {
                $check->restore();
                return redirect(route('agent.index'));
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }

    public function forceDeleted($id){
        try {
            $check = Agent::withTrashed()->findOrFail($id);
            if ($check) {
                $check->forceDelete();
                return redirect(route('agent.index'));
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }
}
