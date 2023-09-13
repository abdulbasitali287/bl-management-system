<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipperRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
        if (isset($path) == "shipper/store" && $mth == "POST") {
            $rules = [
                "name" => 'required | unique:shippers,name',
                "description" => 'required | unique:shippers,description',
                "code" => 'required | max:8 | unique:shippers,code'
            ];
        }elseif($mth == "PUT"){
            $rules = [
                "name" => 'required',
            ];
        }
        return $rules;
    }
}
