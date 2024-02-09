<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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

            'firstname' => 'required|max:75',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'middlename' => '',
            'lastname' => 'required',
            'mobile_no' => 'required|max:10|min:10',
            'date_of_birth' => 'required|date',
            'pan_no' => 'required|max:10|min:10',
            'qualification' => 'required',
            'marital_status' => 'required',
            'joining_date' => 'required|date',
            'experience_in_year' => '',
            'last_package' => '',
            'permanant_address' => 'required',
            'designation' => 'required',
            'current_address' => 'required',
            'home_contactno' => 'required|max:10|min:10',
            'status_id' => 'required',
            'experience_in_months' => '',
            'privious_company_contactname' => '',
            'privious_company_contact' => '',
            'source' => '',
            'source_by' => '',
            'remark_by_HR' => ''
        ];
    }
}
