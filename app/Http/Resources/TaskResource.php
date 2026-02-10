<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'user'          => $this->user,
            'priority'      => $this->priority,
            'category'      => $this->category,
            'assign_to'     => $this->assign_to,
            'project_id'    => $this->project_id,
            'status'        => $this->status,
            'delivered'     => $this->delivered,
            'department_id' => $this->department_id,
            'in_timeline'   => $this->in_timeline,
            'start_task'    => $this->start_task,
            'end_task'      => $this->end_task,
            'problem'       => $this->problem,
            'analyst'       => $this->analyst,
            'solution'      => $this->solution,
            'deleted_at'    => $this->deleted_at,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,


        ];
    }
}
