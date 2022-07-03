<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Category;

class TestController extends Controller
{
    public function index()
    {
        return User::find(1)->address;
    }
}
