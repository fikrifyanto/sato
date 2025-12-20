<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize() { return true; }
    public function rules() {
        $customerId = $this->user()?->id;

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($customerId),
            ],
            'phone' => 'nullable|string|max:30',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ];
    }
}