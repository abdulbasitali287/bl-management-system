<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Shipper;
use App\Models\BillOfLading;
use App\Models\ShippingLine;
use Illuminate\Http\Request;
use App\Http\Requests\BillOfLadingRequest;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class BillOfLadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BillOfLading::with('user')->with('shipper')->with('shipping_line')->get();
        return view('backend.bill-of-lading.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = BillOfLading::with('shipper')->get();
        // dd($users);
        $users = User::get();
        $shippers = Shipper::get();
        $vessel = ShippingLine::get();
        return view('backend.bill-of-lading.create',["users" => $users,"shippers" => $shippers,"vessel" => $vessel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $request->validate([
            "bl_no" => 'required',
            "shipper" => 'required',
            // "vessel" => 'required',
            "port_of_loading" => 'required',
            "port_of_discharge" => 'required',
            // "place_of_receipt" => 'required',
            // "place_of_delivery" => 'required',
            // "shipment_date" => 'required',
        ]);
        $data = [
            'aesl_no' => null,
            'idbn_no' => null,
            'bl_no' => $request->input('bl_no'),
            'shipper_id' => $request->input('shipper'),
            // 'consignee' => empty($request->input('consignee')) ? 'Allied' : $request->input('consignee'),
            // 'vessel_id' => $request->input('vessel'),
            // 'voyage_number' => $request->input('voyage'),
            'port_of_loading' => $request->input('port_of_loading'),
            'port_of_discharge' => $request->input('port_of_discharge'),
            // 'place_of_receipt' => $request->input('place_of_receipt'),
            // 'place_of_delivery' => $request->input('place_of_delivery'),
            'freight_chr' => $request->input('freight'),
            'arrival_date' => $request->input('arrival_date'),
            // 'delivery_date' => $request->input('delivery_date'),
            // 'container_no' => $request->input('container_no'),
            'gross_weight' => $request->input('gross_weight'),
            'pkg_count' => $request->input('pkg_count'),
            'user_id' => auth()->user()->id,
            'status' => $request->status == false ? false : true
        ];

        $check = BillOfLading::create($data);
        if ($check != false && !empty($check)) {
            return redirect(route('bill-of-lading.index'))->with('Added','data added successfully...!');
        }else {
            return redirect(route('bill-of-lading.create'))->with('notAdded','data not added...!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillOfLading  $billOfLading
     * @return \Illuminate\Http\Response
     */
    public function show(BillOfLading $billOfLading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillOfLading  $billOfLading
     * @return \Illuminate\Http\Response
     */
    public function edit(BillOfLading $billOfLading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillOfLading  $billOfLading
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillOfLading $billOfLading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillOfLading  $billOfLading
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillOfLading $billOfLading)
    {
        //
    }
}
