<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartementEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('departement-edit');

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return array_merge(parent::rules(), [
            
        ]);
    }
}
