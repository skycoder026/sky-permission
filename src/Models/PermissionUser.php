<?php

namespace Skycoder\SkyPermission\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $guarded = [];

    protected $table = 'permission_user';

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
