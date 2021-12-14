<?php

namespace Skycoder\SkyPermission\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->hasMany(PermissionUser::class);
    }

    public function permission_group()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
