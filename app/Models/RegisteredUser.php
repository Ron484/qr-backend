<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredUser extends Model
{
    /** @use HasFactory<\Database\Factories\RegisteredUserFactory> */
    use HasFactory;

    protected $primaryKey = 'registration_id';
    public $incrementing = false; 
    protected $keyType = 'string'; 
   

    protected $fillable = [
    'full_name',
    'email',
    'mobile',
    'job_title',
    'company',
];

    public function scan() {
    return $this->hasMany(ScanLog::class,'registration_id');
     }
}
