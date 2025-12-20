<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:home,shelter,office,other',
            'label' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'detail' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ];
    }
}
