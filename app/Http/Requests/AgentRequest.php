<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
        if (isset($path) == "agent/store" && $mth == "POST") {
            $rules = [
                "name" => 'required | unique:agents,name',
            ];
        }elseif($mth == "PUT"){
            $rules = [
                "name" => 'required',
            ];
        }
        return $rules;
    }
}
