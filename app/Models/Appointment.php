<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialty_id', 'doctor_id', 'patient_id', 'schedule_date', 'schedule_time', 'type', 'description',
    ];
    
    public function specialty()
    {
    	return $this->belongsTo(Specialty::class);
    }

    public function doctor()
    {
    	return $this->belongsTo(User::class);
    }

    public function patient()
    {
    	return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasOne(DetailsAppointment::class);
    }

    public function getScheduledTime12Attribute()
    {
    	return (new Carbon($this->schedule_time))->format('g:i A');
    }
}
