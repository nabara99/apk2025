<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
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
            'kode_kegiatan' => 'required|size:4',
            'nama_kegiatan' => 'required|unique:kegiatans,nama_kegiatan',
            'program_id' => 'required',
            'pptk_id' => 'required',
        ];
    }
}
