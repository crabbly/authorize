<?php

namespace Crabbly\Authorize;

trait UserAuthorize
{
    /**
     * Role User Relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('\App\Role')->withTimestamps();
    }

    
    /**
     * Update User Roles.
     *
     * @param $roles
     */
    public function updateRoles(Array $roles)
    {
        $this->roles()->sync($roles);
    }

    
    /**
     * Check if user has Role by name.
     * 
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        foreach ($this->roles as $uRole)
        {
            if ($uRole->name === $role)
            {
                return true;
            }
        }
        return false;
    }


    /**
     * Check if user is an administrator by checking if it has the Role of name 'admin'.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }


    /**
     * Check if User has Permission. It will also accept an array of Permissions.
     * When passing an array or permissions, adicional param allow us to specify we we require User
     * to have all permissions in the array.
     *
     * @param $permission
     * @param bool $requireAll
     * @return bool
     */
    public function hasPermission($permission)
    {
        foreach ($this->rolesWithPermissions as $role) {
            foreach ($role->permissions as $perm) {
                if ($perm->name === $permission) {
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Role User relation. Eager loading permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rolesWithPermissions()
    {
        return $this->belongsToMany('\App\Role')->with('permissions');
    }
}
