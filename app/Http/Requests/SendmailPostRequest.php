<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

class SendmailPostRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'name' => 'required|min:2|max:100',
            'emailAddress' => 'email|required|min:2|max:255',
            'subject' => 'required|min:2|max:255',
            'content' => 'required|min:5',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'failure',
            'message' => $validator->errors()->first(),
            'data' => null
        ], Response::HTTP_BAD_REQUEST));
    }

    /**
     * Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => 'trim',
            'emailAddress' => 'trim',
            'subject' => 'trim',
            'content' => 'trim',
        ];
    }
}
