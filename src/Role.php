<?php

namespace Crabbly\Authorize;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * Role User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }


    /**
     * Permission Role relationship.
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany('Crabbly\Authorize\Permission')->withTimestamps();
    }


    /**
     * Update role permissions.
     *
     * @param $permissions
     */
    public function updatePermissions(Array $permissions)
    {
        $this->permissions()->sync($permissions);
    }
}
