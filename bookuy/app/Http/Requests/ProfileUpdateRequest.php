<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Accept both old and new field names for backward compatibility
            'name' => ['sometimes', 'string', 'max:255'],
            'username' => ['sometimes', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'gender' => ['nullable', 'string', 'in:Male,Female,Other'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:8'],
            'description' => ['nullable', 'string', 'max:1000'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
            'role' => ['nullable', 'string', 'in:user,admin,seller'],
        ];
    }
    
    protected function prepareForValidation()
    {
        // Map old field names to new ones for backward compatibility
        $data = [];
        
        if ($this->has('name') && !$this->has('username')) {
            $data['username'] = $this->input('name');
        }
        
        if ($this->has('phone_number') && !$this->has('no_telp')) {
            $data['no_telp'] = $this->input('phone_number');
        }
        
        if (!empty($data)) {
            $this->merge($data);
        }
    }
}
