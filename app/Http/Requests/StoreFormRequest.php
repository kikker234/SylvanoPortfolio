<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
        return [
            "title" => "required|string",
            "fields" => "required|array",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $fields = $this->input("fields");
            foreach ($fields as $field) {
                if (!isset($field["label"]) || !isset($field["type"])) {
                    $validator->errors()->add("fields", "Every field must have a label and type");
                }
            }
        });
    }
}
