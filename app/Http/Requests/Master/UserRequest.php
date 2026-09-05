<?php
namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:50',
                Rule::unique('users', 'username')
                    ->ignore($user?->id, 'id'),
            ],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:6'],
            'department' => ['required', 'integer'],
            'opt_status' => ['required', 'integer'],
        ];
    }

    public function payload(): array
    {
        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'department' => $this->department,
            'opt_status' => $this->opt_status,
        ];

        if ($this->filled('password')) {
            $data['password'] = $this->password;
        }

        return $data;
    }
}
