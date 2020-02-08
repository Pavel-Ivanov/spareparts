<?php

namespace App\Http\Controllers;

use App\Entities\Sparepart;
//use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function store()
    {
        $sparepart = Sparepart::create($this->validateRequest());

        return redirect($sparepart->path());
    }

    public function update(Sparepart $sparepart)
    {
        $sparepart->update($this->validateRequest());

        return redirect($sparepart->path());
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();

        return redirect('/spareparts');
    }

    protected function validateRequest()
    {
        return \request()->validate([
            'name'         => 'required',
            'manufacturer' => 'required',
        ]);
    }
}
