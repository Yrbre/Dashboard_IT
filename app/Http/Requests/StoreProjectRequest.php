<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name'                  => 'required|string|max:255',
            'responsibility_id'     => 'required|integer|exists:users,id',
            'client'                => 'required|string|max:255',
            'progress'              => 'required|integer|min:0|max:100',
            'status'                => 'required|string',
            'schedule_start'        => 'required|date',
            'schedule_end'          => 'required|date|after_or_equal:schedule_start',
            'actual_start'          => 'nullable|date',
            'actual_end'            => 'nullable|date|after_or_equal:actual_start',
            'description'           => 'nullable|string',
        ];
    }
}
