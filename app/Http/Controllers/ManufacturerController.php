<?php

namespace App\Http\Controllers;

use App\Entities\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function store()
    {
        Manufacturer::create(\request()->only([
            'name', 'country', 'dob'
        ]));
    }
}
