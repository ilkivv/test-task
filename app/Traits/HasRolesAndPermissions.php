<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRolesAndPermissions
{
    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * @param array ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission)->count();
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles() as $role) {
            if ($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }

    /**
     * @param array ...$permissions
     * @return HasRolesAndPermissions
     */
    public function addPermissions(...$permissions)
    {
        $permissions = $this->getPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function addRoles(...$roles)
    {
        $roles = $this->getRoles($roles);

        if(empty($roles)) return $this;

        return $this->roles()->saveMany($roles);
    }

    public function getRoleById($id)
    {
        $roleModel = new Role();
        return $roleModel->getRoleById($id);
    }

    /**
     * @param $permissions
     * @return mixed
     */
    protected function getPermissions($permissions)
    {
        $permissionModel = new Permission();
        return $permissionModel->getAllPermissions($permissions);
    }

    protected function getRoles($roles)
    {
        $roleModel = new Role();
        return $roleModel->getAllRolesByNames($roles);
    }

    /**
     * @param array ...$permissions
     * @return $this
     */
    public function deletePermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @return HasRolesAndPermissions
     */
    public function deleteAllPermissions()
    {
        return $this->permissions()->detach();
    }

    /**
     * @param array ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->addPermissions($permissions);
    }
}