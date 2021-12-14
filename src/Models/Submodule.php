<?php

namespace Skycoder\SkyPermission\Models;

use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    protected $guarded = [];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function permission_groups()
    {
        return $this->hasMany(PermissionGroup::class);
    }
}
