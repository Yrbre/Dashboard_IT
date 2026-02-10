<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'name'          => 'sometimes|string|max:255',
            'user'          => 'sometimes|string|max:255',
            'priority'      => 'sometimes|string|max:255',
            'category'      => 'sometimes|string|max:255',
            'assign_to'     => 'sometimes|exists:users,id',
            'project_id'    => 'sometimes|exists:projects,id',
            'status'        => 'sometimes|in:NEW,ON PROGRESS,COMPLETED,ON HOLD,CANCELLED',
            'delivered'     => 'sometimes|exists:users,id',
            'department_id' => 'sometimes|exists:departments,id',
            'in_timeline'   => 'sometimes|boolean',
            'start_task'    => 'sometimes|date',
            'end_task'      => 'sometimes|date|after_or_equal:start_task',
            'problem'       => 'sometimes|string',
            'analysts'      => 'sometimes|string',
            'solution'      => 'sometimes|string',
        ];
    }
}
