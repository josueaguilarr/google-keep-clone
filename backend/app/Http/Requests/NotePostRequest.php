<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class NotePostRequest extends FormRequest
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
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:1|max:20000',
            'isFixed' => 'required|max:1|numeric'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error en la validación de campos para crear la nota',
            'fields' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'title' => 'El titulo es requerido',
            'content' => 'El contenido es requerido',
            'isFixed' => 'El archivado es requerido'
        ];
    }
}
