<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'doctor_name' => $this->doctor_name,
            'doctor_specialty' => $this->doctor_specialty,
            'doctor_certificate_image' => $this->doctor_certificate_image,
            'doctor_phone' => $this->doctor_phone,
            'doctor_password' => $this->doctor_password,
            'doctor_description' => $this->doctor_description,
            'doctor_ident' => $this->doctor_ident,
            'doctor_license_number' => $this->doctor_license_number,
            'doctor_license_image' => $this->doctor_license_image,
            'address_clinc_doctor' => $this->address_clinc_doctor,
            'id_clinc' => $this->id_clinc,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
