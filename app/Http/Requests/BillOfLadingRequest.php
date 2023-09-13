<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillOfLadingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $mth = $this->method();
        $path = $this->path();

        if (isset($path) == "bill-of-lading/store" && $mth == "POST") {
            $rules = [
                "bl_no" => 'required | unique:bill_of_ladings,bl_no',
                "aesl_no" => 'required | unique:bill_of_ladings,aesl_no',
                "shipper_id" => 'required',
                "vessel_id" => 'required',
                "port_of_loading" => 'required',
                "port_of_discharge" => 'required',
                "place_of_receipt" => 'required',
                "place_of_delivery" => 'required',
                "shipment_date" => 'required',
            ];
        }elseif($mth == "PUT"){
            $rules = [
                "bl_no" => 'required',
                "aesl_no" => 'required',
                "shipper_id" => 'required',
                "vessel_id" => 'required',
                "port_of_loading" => 'required',
                "port_of_discharge" => 'required',
                "place_of_receipt" => 'required',
                "place_of_delivery" => 'required',
                "shipment_date" => 'required',
            ];
        }

        return $rules;
    }
}
