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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $user = $this->user();
        $rules = [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:50'],
        ];

        // Signature upload is allowed only for doctors and admins
        if (in_array($user->role, ['doctor', 'admin'])) {
            $rules['signature'] = ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'];
            $rules['license_number'] = ['nullable', 'string', 'max:50'];
            $rules['ptr_number'] = ['nullable', 'string', 'max:50'];
        }

        return $rules;
    }
}
