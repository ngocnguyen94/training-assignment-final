<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $parent_id = $this->parent_id == null ? '0' : $this->parent_id;
        return [
            'name' => 'required|min:5|max:255',
            'academy_program_id' => 'required',
            'order' => 'required',
            // 'order' => 'required|unique:academy_modules,order,NULL,id,parent_id,'.$parent_id,
            // The meaning of the unique rule for order column: "value of order must be unique among
            // all existing modules that have parent_id of the same value of this module's parent_id".
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
