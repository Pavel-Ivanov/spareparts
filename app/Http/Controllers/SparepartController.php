<?php

namespace App\Http\Controllers;

use App\Entities\Sparepart;
//use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function store()
    {
        Sparepart::create($this->validateRequest());
    }

    protected function update(Sparepart $sparepart)
    {
        $sparepart->update($this->validateRequest());
    }

    private function validateRequest()
    {
        return \request()->validate([
            'name'         => 'required',
            'manufacturer' => 'required',
        ]);
    }
}
