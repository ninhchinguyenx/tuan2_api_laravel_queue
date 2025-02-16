<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->segment(4);
        return [
            'name' => 'nullable','string','max:255',
            'email' => 'sometimes','string','email','max:255','unique:users,email,' . $userId,
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors();
        $response =  response()->json([
            'error' => $error->messages()
        ],Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }

    
}
