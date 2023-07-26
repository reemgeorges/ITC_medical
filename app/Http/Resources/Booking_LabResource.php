<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Booking_LabResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_lab_name' => $this->booking_lab_name,
            'booking_lab_father_name' => $this->booking_lab_father_name,
            'booking_lab_age' => $this->booking_lab_age,
            'booking_lab_gender' => $this->booking_lab_gender,
            'name_analysis' => $this->name_analysis,
            'lab_id' => $this->lab_id,
            'doctor_lab_id' => $this->doctor_lab_id,
            'status_booking_lab' => $this->status_booking_lab,
            'review_lab' => $this->review_lab,
            'user_id' => $this->user_id,
            'booking_date' => $this->booking_date,
            'booking_datetime' => $this->booking_datetime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
