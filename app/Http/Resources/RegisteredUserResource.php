<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisteredUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

         $mobile = $this->mobile ?? null;

    if ($mobile) {
        $mobile = preg_replace('/^\+\d{3}/', '0', $mobile);
    }

         return [
            'registrationID' => $this->registration_id??'', 
            'fullName' => $this->full_name??'', 
            'email' => $this->email,
            'mobile' => $mobile ?? '',
            'jobTitle' => $this->job_title ?? '',
            'company' => $this->company ?? '', 
        ];  
    }
}
