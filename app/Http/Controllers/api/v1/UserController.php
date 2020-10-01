<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(User $userModel)
    {
        $users = $userModel->getUsers();
        if (!empty($users)){
            return new JsonResponse(['users' => $users], 200);
        }else{
            return new JsonResponse(['error' => "Не найдено ни одного пользователя"], 200);
        }
    }
}
