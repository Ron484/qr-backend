<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RegisteredUserResource;

class ScanLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user= new RegisteredUserResource($this->whenLoaded('user'));
     return [
            'registrationID' => $this->registration_id ?? '',
            'isScanned' => (bool)$this->is_scanned??false,
            'scanTime' => $this->scan_time,
            'user' => $user,
            
        ];  
        
    }
}




//  'scan_time' => $this->scan_time
//         ? Carbon::parse($this->scan_time)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s')
//         : null,