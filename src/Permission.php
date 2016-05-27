<?php

namespace Crabbly\Authorize;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Permission Role relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Permissions');
    }
}
