<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Station;

class TestController extends Controller
{
    public function index()
    {
        return Invoice::find(23)->categories;
    }
}
