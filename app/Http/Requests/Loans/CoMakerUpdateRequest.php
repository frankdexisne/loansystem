<?php

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CoMakerUpdateRequest extends FormRequest
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
            'lname'=>[
                'required',
                Rule::unique('mysql.co_makers')
                    ->ignore($this->co_maker_id)
                    ->where('lname',$this->lname)
                    ->where('fname',$this->fname)
                    ->where('mname',$this->mname)
            ],
            'fname'=>'required',
            'mname'=>'required',
            'dob'=>'required|date',
            'gender'=>'required|in:MALE,FEMALE',
            'contact_no'=>'required',
            'company'=>'required',
            'position'=>'required',
            'monthly_salary'=>'required|numeric',
            'city_id'=>'required|exists:dbsystem.philippine_cities,city_municipality_code',
            'philippine_barangay_id'=>'required|exists:dbsystem.philippine_barangays,id',
            'street'=>'required'
        ];
    }

    public function messages(){
        return [
            'lname.unique'=>'Name is already taken'
        ];
    }
}
