<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'justification', 'cancelled_by',
    ];

    public function cancelled_by()
    {
    	return $this->belongsTo(User::class);
    }
}
