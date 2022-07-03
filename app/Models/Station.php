<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;
use App\Models\Inventory;
use App\Models\WorkPost;

class Station extends Model
{
    use HasFactory;

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }


    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function workPosts()
    {
        return $this->hasMany(WorkPost::class);
    }
}
