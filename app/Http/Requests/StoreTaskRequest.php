<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'user'          => 'required|string|max:255',
            'priority'      => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'assign_to'     => 'required|exists:users,id',
            'project_id'    => 'required|exists:projects,id',
            'status'        => 'required|in:NEW,ON PROGRESS,COMPLETED,ON HOLD,CANCELLED',
            'delivered'     => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'in_timeline'   => 'required|boolean',
            'start_task'    => 'required|date',
            'end_task'      => 'required|date|after_or_equal:start_task',
            'problem'       => 'required|string',
            'analysts'      => 'required|string',
            'solution'      => 'required|string',
        ];
    }
}
