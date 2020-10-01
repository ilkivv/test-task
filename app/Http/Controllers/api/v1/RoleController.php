<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRoles(Role $roleModel)
    {
        $roles = $roleModel->getRoles();
        if (count($roles) > 0){
            return new JsonResponse(['roles' => $roles], 200);
        }else{
            return new JsonResponse(['error' => 'Нет ролей'], 200);
        }

    }

    public function addRole(Request $request, Role $roleModel)
    {
        $params = $request->all();
        $role = $roleModel->addRole($params);
        if (!empty($role)){
            return new JsonResponse(['role' => $role], 200);
        }else{
            return new JsonResponse(['error' => 'Ошибка добавления записи'], 200);
        }
    }

    public function updateRole(Request $request, Role $roleModel, $id)
    {
        $params = $request->all();
        $role = $roleModel->updateRole($id, $params);
        if ($role){
            $role = $roleModel->getRole($id);
            return new JsonResponse(['role' => $role], 200);
        }else{
            return new JsonResponse(['error' => 'Ошибка обновления записи'], 200);
        }
    }

    public function deleteRole(Role $roleModel, $id)
    {
        $role = $roleModel->deleteRole($id);
        if ($role){
            return new JsonResponse(['role' => $role], 200);
        }else{
            return new JsonResponse(['error' => 'Ошибка удаления записи'], 200);
        }
    }
}
