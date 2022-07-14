<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Station;
use App\Models\Region;
use App\Models\Branch;

class Address extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function region()
    {
        return $this->hasOne(Region::class);
    }

    public function branch()
    {
        return $this->hasOne(Branch::class);
    }
}
