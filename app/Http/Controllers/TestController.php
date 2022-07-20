<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Region;
use App\Models\Station;

class TestController extends Controller
{
    public function index()
    {
        return Region::find(10)->branches;
    }
}
