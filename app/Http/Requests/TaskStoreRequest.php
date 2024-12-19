<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'due_date' => ['required', 'date', 'after:now'],
            'assigned_to' => ['array'],
            'assigned_to.*' => ['exists:users,id']
        ];
    }
}
