<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Station;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\VacationDetail;
use App\Models\WorkingHour;
use App\Models\WorkPost;

class User extends Model
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo(Address::class);
    }



    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function vacationDetails()
    {
        return $this->hasMany(VacationDetail::class);
    }

    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class);
    }

    public function workPosts()
    {
        return $this->hasMany(WorkPost::class);
    }
}
