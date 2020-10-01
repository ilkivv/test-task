<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function getSchools(School $schoolModel)
    {
        $schools = $schoolModel->getSchools();

        if (!empty($schools)){
            return new JsonResponse(['schools' => $schools], 200);
        }else{
            return new JsonResponse(['error' => "Не найдено ни одной школы"], 200);
        }
    }

    public function addSchool(Request $request, School $schoolModel)
    {
        $params = $request->all();
        $school = $schoolModel->addSchool($params);

        if (!empty($school)){
            return new JsonResponse(['school' => $school], 200);
        }else{
            return new JsonResponse(['error' => "Ошибка добавления записи"], 200);
        }
    }

    public function updateSchool(Request $request, School $schoolModel, $id)
    {
        $params = $request->all();
        $school = $schoolModel->updateSchool($id, $params);
        if (!empty($school)){

            $school = $schoolModel->getSchool($id);
            return new JsonResponse(['school' => $school], 200);
        }else{
            return new JsonResponse(['error' => "Ошибка обновления записи, возможно такая запись не найдена"], 200);
        }
    }

    public function deleteSchool(School $schoolModel, $id)
    {
        $result = $schoolModel->deleteSchool($id);

        if ($result){
            return new JsonResponse(['success' => "Запись успешно удалена"], 200);
        }else{
            return new JsonResponse(['error' => "Ошибка удаления записи, возможно такая запись не найдена"], 200);
        }
    }
}
