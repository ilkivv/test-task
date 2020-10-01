<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->get();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function addRole($params)
    {
        return $this->create($params);
    }

    /**
     * @param $id
     * @param $params
     * @return bool
     */
    public function updateRole($id, $params)
    {
        $role = $this->find($id);
        if($role){
            return $role->update($params);
        }else{
            return false;
        }

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteRole($id)
    {
        $role = $this->find($id);
        if($role){
            return $role->delete();
        }else{
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRole($id)
    {
        return $this->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
