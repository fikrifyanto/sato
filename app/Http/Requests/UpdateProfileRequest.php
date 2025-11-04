<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize() { return true; }
    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'phone' => 'nullable|string|max:30',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ];
    }
}