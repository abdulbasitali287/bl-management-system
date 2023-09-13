<?php

namespace App\Http\Controllers;

use App\Models\ShippingLine;
use Illuminate\Http\Request;
use App\Http\Requests\ShippingLineRequest;

class ShippingLineController extends Controller
{
    public function index()
    {
        $data = ShippingLine::with('users')->get();
        return view('backend.shipping-line.index',['data' => $data]);
    }

    public function create()
    {
        $shippingLines = array(
            'CMA CGM' => 'CMA CGM Group',
            'Maersk Line' => 'A.P. Moller - Maersk',
            'MSC' => 'Mediterranean Shipping Company',
            'Evergreen Line' => 'Evergreen Marine Corporation',
            'Hapag-Lloyd' => 'Hapag-Lloyd AG',
            'Cosco Shipping' => 'China Ocean Shipping Company',
            'ONE' => 'Ocean Network Express',
            'NYK Line' => 'Nippon Yusen Kaisha',
            'OOCL' => 'Orient Overseas Container Line',
            'MOL' => 'Mitsui O.S.K. Lines',
            'ZIM' => 'ZIM Integrated Shipping Services',
            'Hyundai Merchant Marine' => 'Hyundai Merchant Marine Co., Ltd.',
            'Wan Hai Lines' => 'Wan Hai Lines Ltd.',
            'Yang Ming Marine Transport' => 'Yang Ming Marine Transport Corporation',
            'PIL' => 'Pacific International Lines'
        );
        return view('backend.shipping-line.create',['shippingLine' => $shippingLines]);
    }

    public function store(ShippingLineRequest $request)
    {
        try {
            $request->validated();
            ShippingLine::create([
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'status' => $request->status == false ? false : true
            ]);
            return redirect(route('shipping-line.index'))->with('added','data added successfully...!');
        } catch (Exception $ex) {
            return redirect(route('shipping-line.create'))->with('notAdded','data not added...!');
        }
    }

    public function edit($id)
    {
        $update = ShippingLine::findOrFail($id);
        return view('backend.shipping-line.edit',['update' => $update]);
    }

    public function update(ShippingLineRequest $request,$id)
    {
        $data = $request->validated();

        $check = ShippingLine::where('ship_id',$id)->update([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'status' => $request->status == false ? false : true
        ]);
        if ($check) {
            return redirect(route('shipping-line.index'))->with('updated','data updated successfully...!');
        }else{
            return redirect(route('shipping-line.edit'))->with('notUpdated','data not updated...!');
        }
    }

    public function trash($id)
    {
        try {
            $check = ShippingLine::findOrFail($id);
            if ($check) {
                $check->delete();
                return redirect(route('shipping-line.index'))->with('deleted','data deleted successfully...!');
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }

    public function trashed(){
        $data = ShippingLine::with('users')->onlyTrashed()->get();
        return view('backend.shipping-line.trash',['data' => $data]);
    }

    public function restoreTrash($id){
        try {
            $check = ShippingLine::withTrashed()->findOrFail($id);
            if ($check) {
                $check->restore();
                return redirect(route('shipping-line.index'));
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }

    public function forceDeleted($id){
        try {
            $check = ShippingLine::withTrashed()->findOrFail($id);
            if ($check) {
                $check->forceDelete();
                return redirect(route('shipping-line.index'));
            }else{
                abort(404);
            }
        } catch (Exception $th) {
            abort(404);
        }
    }
}
