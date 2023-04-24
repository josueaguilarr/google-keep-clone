<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class NoteArchiveRequest extends FormRequest
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
            'title' => 'min:1|max:255|string',
            'content' => 'min:1|max:20000|string',
            'isFixed' => 'required|max:1|numeric',
            'isArchived' => 'required|max:1|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error en la validación de campos para archivar la nota',
            'fields' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'title' => 'El titulo es requerido',
            'content' => 'El contenido es requerido',
            'isFixed' => 'El fijador es requerido',
            'isArchived' => 'El archivado es requerido',
        ];
    }
}
