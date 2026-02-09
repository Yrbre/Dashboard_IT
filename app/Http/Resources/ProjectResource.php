<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'responsibility_id'     => $this->responsibility_id,
            'client'                => $this->client,
            'progress'              => $this->progress,
            'status'                => $this->status,
            'schedule_start'        => $this->schedule_start,
            'schedule_end'          => $this->schedule_end,
            'actual_start'          => $this->actual_start,
            'actual_end'            => $this->actual_end,
            'description'           => $this->description,
        ];
    }
}
