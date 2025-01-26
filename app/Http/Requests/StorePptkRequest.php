<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePptkRequest extends FormRequest
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
            'nip_pptk' => 'required|unique:pptks,nip_pptk|size:21',
            'nama_pptk' => 'required|unique:pptks,nama_pptk|min:5',
        ];
    }
}
