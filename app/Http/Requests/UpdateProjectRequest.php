<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name'                  => 'sometimes|string|max:255',
            'responsibility_id'     => 'sometimes|exists:users,id',
            'client'                => 'sometimes|string|max:255',
            'progress'              => 'sometimes|integer|min:0|max:100',
            'status'                => 'sometimes|string|in:NEW,ON PROGRESS,COMPLETED,ON HOLD,CANCELLED',
            'schedule_start'        => 'sometimes|date',
            'schedule_end'          => 'sometimes|date|after_or_equal:schedule_start',
            'actual_start'          => 'sometimes|date',
            'actual_end'            => 'sometimes|date|after_or_equal:actual_start',
            'description'           => 'sometimes|string',
        ];
    }
}
