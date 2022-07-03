<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Station;
use App\Models\Category;

class Inventory extends Model
{
    use HasFactory;

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
