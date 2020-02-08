<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sparepart extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/spareparts/' . $this->id;
//        return '/spareparts/' . $this->id . '-' . Str::slug($this->name);
    }
}
