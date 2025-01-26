<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenerimaRequest extends FormRequest
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
            'nama_penerima' => 'required|min:4',
            'jabatan_penerima' => 'required',
            'alamat' => 'required|min:5',
            'bank' => 'required',
            'rek_bank' => 'required|unique:penerimas,rek_bank|min:5'
        ];
    }
}
