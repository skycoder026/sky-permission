<?php

namespace Skycoder\SkyPermission\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];

    public function submodules()
    {
        return $this->hasMany(Submodule::class);
    }

    public function scopeActive($q)
    {
        return $q->whereStatus(1);
    }
}
