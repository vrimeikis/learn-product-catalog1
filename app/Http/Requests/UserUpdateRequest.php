<?php

declare(strict_types=1);

namespace App\Http\Requests;

class UserUpdateRequest extends UserCreateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'name' => 'string|max:30',
            'last_name' => 'nullable|alpha|max:50',
            'email' => 'email|unique:users,email,' . $this->user,
            'password' => 'nullable|min:6|confirmed',
        ];

    }

    public function updatePassword(): ?string
    {
        return $this->input('password');
    }

}
