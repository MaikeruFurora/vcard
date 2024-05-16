<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
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
        return [
            'rules' => [
                'fname' => ['required', 'string', 'max:100'],
                'mname' => ['required', 'string', 'max:100'],
                'lname' => ['required', 'string', 'max:100'],
            ],
            'messages' => [
                'fname.required' => 'First name is required',
                'mname.required' => 'Middle name is required',
                'lname.required' => 'Last name is required',
            ],
        ];
        
    }
}
