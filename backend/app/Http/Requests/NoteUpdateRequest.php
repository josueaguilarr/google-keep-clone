<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class NoteUpdateRequest extends FormRequest
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
            'title' => 'min:1|max:255',
            'content' => 'min:1|max:20000',
            'isFixed' => 'max:1|numeric',
            'isArchived' => 'max:1|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error en la validación de campos para actualizar la nota',
            'fields' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'title' => 'El titulo no cumple el formato solicitado',
            'content' => 'El contenido no cumple el formato solicitado',
            'isFixed' => 'El fijador no cumple el formato solicitado',
            'isFixed' => 'El archivador no cumple el formato solicitado',
        ];
    }
}
