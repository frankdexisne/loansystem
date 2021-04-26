<?php

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

class BeneficiaryUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'lname'=>'required',
            'fname'=>'required',
            'mname'=>'required',
            'gender'=>'required|in:MALE,FEMALE',
            'relationship_id'=>'required|exists:mysql.relationships,id'
        ];
    }
}
