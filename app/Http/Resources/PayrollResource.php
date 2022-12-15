<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'staff_name' => $this->staff->first_name_kh . ' '. $this->staff->first_name_kh,
            'position' => $this->staff->positions->name,
            'base_salary' => $this->staff->base_salary,
            'rate_per_hour' => $this->staff->rate_per_hour,
            'num_hour' => $this->sumAttendance($this->staff->id),
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
