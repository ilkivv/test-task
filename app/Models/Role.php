<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRoles()
    {
        return $this->get();
    }

    public function addRole($params)
    {
        return $this->create($params);
    }

    public function updateRole($id, $params)
    {
        $role = $this->find($id);
        if($role){
            return $role->update($params);
        }else{
            return false;
        }

    }

    public function deleteRole($id)
    {
        $role = $this->find($id);
        if($role){
            return $role->delete();
        }else{
            return false;
        }
    }

    public function getRole($id)
    {
        return $this->find($id);
    }
}
