<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryDashBoard extends Controller
{
    public function index(){
        return view('inventory.pages.home');
    }
}
