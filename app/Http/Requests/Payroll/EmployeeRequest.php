<?php

namespace App\Http\Requests\Payroll;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class EmployeeRequest extends FormRequest
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
                Rule::unique('dbpayroll.employees')
                    ->ignore($this->id)
                    ->where('lname',$this->lname)
                    ->where('fname',$this->fname)
                    ->where('mname',$this->mname)
            ],
            'fname'=>'required',
            'mname'=>'required',
            'gender'=>'required',
            'job_title_id'=>'required|exists:dbpayroll.job_titles,id',
            'branch_id'=>'required|exists:mysql.branches,id',
        ];
    }

    public function messages(){
        return [
            'lname.unique'=>'Name is already taken'
        ];
    }
}
