<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //check user by certain condtion  and return a bool 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //validate payoad body
        //lenght/size of item
        // data type of item eg:string,numeric
        //data format of item eg: date,regex
        return [
            'name'=>'string|max:225',
            'secret'=>[
                'required',
                'string',
                'alpha_num',
                'min:5'
            ],
            //
        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'hey your name is unacceptableeee'
        ];
    }
}
