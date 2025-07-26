<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanLog extends Model
{
    /** @use HasFactory<\Database\Factories\ScanLogFactory> */
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'is_scanned',
        'scan_time',
    ];
// public $timestamps = true;

    public function user()
    {
    return $this->belongsTo(RegisteredUser::class,'registration_id');
    }
}
