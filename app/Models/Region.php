<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\User;
use App\Models\Address;

class Region extends Model
{
    use HasFactory;

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
