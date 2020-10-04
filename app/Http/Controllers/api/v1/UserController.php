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

    const PERMISSION_ACCESS_TO_STUDENTS = 'Access to CRUD students';
    const ROLE_ADMINISTRATOR = 'Administrator';

    const STUDENT = "student";
    const WORKER = "worker";

    /**
     * @param User $userModel
     * @return JsonResponse
     */
    public function getUsers(User $userModel)
    {
        $users = $userModel->getUsers();
        if (!empty($users)){
            return new JsonResponse(['users' => $users], 200);
        }else{
            return new JsonResponse(['error' => "Не найдено ни одного пользователя"], 200);
        }
    }

    public function getUserById(User $userModel, $id)
    {
        $user = $userModel->getUserById($id);

        if (!empty($user)){
            return new JsonResponse(['user' => $user], 200);
        }else{
            return new JsonResponse(['error' => "Пользователя с id:" . $id . " не найдено."], 200);
        }
    }

    /**
     * @param User $userModel
     * @param $type
     * @return JsonResponse
     */
    public function getAllUsers(User $userModel, $type)
    {
        $current_user = $userModel->getCurrentUser();

        if ($type === self::STUDENT && $current_user->hasPermission(self::PERMISSION_ACCESS_TO_STUDENTS)){

            $students = $userModel->getAllStudents();
            return new JsonResponse(['students' => $students], 200);
        } else if ($type === self::WORKER){
            $workers = $userModel->getAllWorkers();
            return new JsonResponse(['workers' => $workers], 200);
        } else{
            return new JsonResponse(['error' => "У вас недостаточно прав для просмотра"], 200);
        }
    }

    /**
     * @param User $userModel
     * @param $type
     * @param $school_id
     * @return JsonResponse
     */
    public function getAllUsersBySchoolId(User $userModel, $type, $school_id)
    {
        $current_user = $userModel->getCurrentUser();

        if ($type === self::STUDENT && $current_user->hasPermission(self::PERMISSION_ACCESS_TO_STUDENTS)){

            $students = $userModel->getAllStudentsBySchoolId($school_id);

            if (!empty($students)){
                return new JsonResponse(['students' => $students], 200);
            }else{
                return new JsonResponse(['error' => "В школе с id:" . $school_id . " нет учеников"], 200);
            }

        } else if ($type === self::WORKER){
            $workers = $userModel->getAllWorkersBySchoolId($school_id);

            if (!empty($workers)){
                return new JsonResponse(['workers' => $workers], 200);
            }else{
                return new JsonResponse(['error' => "В школе с id:" . $school_id . " нет работников"], 200);
            }
        } else{
            return new JsonResponse(['error' => "У вас недостаточно прав для просмотра"], 200);
        }
    }

    /**
     * @param Request $request
     * @param User $userModel
     * @param $id
     * @return JsonResponse
     */
    public function updateUserById(Request $request, User $userModel, $id)
    {
        $current_user = $userModel->getCurrentUser();

        if ($current_user->hasPermission(self::PERMISSION_ACCESS_TO_STUDENTS)) {

            $params = $request->all();
            $user = $userModel->updateUserById($id, $params);

            return new JsonResponse(['user' => $user], 200);
        }else{
            return new JsonResponse(['error' => "У вас недостаточно прав для изменения"], 200);
        }
    }

    public function exceptionOrDismissalUserById(Request $request, User $userModel, $id)
    {
        $current_user = $userModel->getCurrentUser();

        if ($current_user->hasPermission(self::PERMISSION_ACCESS_TO_STUDENTS)) {
            $params = $request->all();
            $user = $userModel->exceptionOrDismissalUserById($params, $id);
            return new JsonResponse(['user' => $user], 200);
        }

        return new JsonResponse(['error' => "У вас недостаточно прав для изменения"], 200);
    }

    /**
     * @param User $userModel
     * @param $id
     * @return JsonResponse
     */
    public function deleteUserById(User $userModel, $id)
    {
        $current_user = $userModel->getCurrentUser();

        if ($current_user->hasPermission(self::PERMISSION_ACCESS_TO_STUDENTS)) {

            $result = $userModel->deleteUserById($id);
            return new JsonResponse(['success' => $result], 200);
        }

        return new JsonResponse(['error' => "У вас недостаточно прав для изменения"], 200);
    }

    /**
     * @param Request $request
     * @param User $userModel
     * @return JsonResponse
     */
    public function addUser(Request $request, User $userModel)
    {
        $current_user = $userModel->getCurrentUser();

        if ($current_user->hasPermission(self::PERMISSION_ACCESS_TO_STUDENTS)) {

            $params = $request->all();
            $params['password'] = bcrypt($params['password']);
            $user = $userModel->addUser($params);

            if ($user){
                return new JsonResponse(['user' => $user], 200);
            }else{
                return new JsonResponse(['error' => "Пользователь с такими данными уже сушествует"], 200);
            }
        }

        return new JsonResponse(['error' => "У вас недостаточно прав для изменения"], 200);
    }
}
