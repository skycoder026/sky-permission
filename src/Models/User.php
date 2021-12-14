<?php

namespace Skycoder\SkyPermission\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->where('status', 1);
    }
}
