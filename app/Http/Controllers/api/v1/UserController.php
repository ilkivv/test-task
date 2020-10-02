<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HasRolesAndPermissions;

    public function getUsers(User $userModel)
    {
        $users = $userModel->getUsers();
        if (!empty($users)){
            return new JsonResponse(['users' => $users], 200);
        }else{
            return new JsonResponse(['error' => "Не найдено ни одного пользователя"], 200);
        }
    }

    public function getAllStudents(User $userModel)
    {
        $current_user = $userModel->getCurrentUser();

        //dd($current_user->hasRole('Administrator'));
        //dd($current_user->addPermissions('Access to CRUD students'));
        //dd($current_user->deleteAllPermissions());
        //dd($current_user->hasPermission('Access to CRUD students'));

        if ($current_user->hasPermission('Access to CRUD students')){

            $students = $userModel->getAllStudents();
            return new JsonResponse(['students' => $students], 200);
        }else{
            return new JsonResponse(['error' => "У вас недостаточно прав для просмотра"], 200);
        }
    }

    public function updateStudent(Request $request, User $userModel, $id)
    {
        $current_user = $userModel->getCurrentUser();

        if ($current_user->hasPermission('Access to CRUD students')) {

            $params = $request->all();



            return new JsonResponse(['students' => $students], 200);
        }else{
            return new JsonResponse(['error' => "У вас недостаточно прав для просмотра"], 200);
        }
    }

    public function exceptionStudent()
    {
        
    }

    public function deleteStudent()
    {

    }

    public function addStudent()
    {

    }
}
