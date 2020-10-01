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

        if (!$schools->isEmpty()){
            return new JsonResponse(['schools' => $schools], 200);
        }else{
            return new JsonResponse(['error' => "Не найдено ни одной школы"], 200);
        }
    }

    public function addSchool(Request $request, School $schoolModel)
    {
        $params = $request->all();
        $school = $schoolModel->addSchool($params);

        if (!$school->isEmpty()){
            return new JsonResponse(['school' => $school], 200);
        }else{
            return new JsonResponse(['error' => "Ошибка добавления записи"], 200);
        }
    }

    public function updateSchool(Request $request, School $schoolModel, $id)
    {
        $params = $request->all();
        $school = $schoolModel->updateSchool($id, $params);

        if (!$school){

            $school = $schoolModel->getSchool($id);
            return new JsonResponse(['school' => $school], 200);
        }else{
            return new JsonResponse(['error' => "Ошибка обновления записи"], 200);
        }
    }

    public function deleteSchool(School $schoolModel, $id)
    {
        $result = $schoolModel->deleteSchool($id);

        if ($result){
            return new JsonResponse(['result' => $result], 200);
        }else{
            return new JsonResponse(['error' => "Ошибка удаления записи"], 200);
        }
    }
}
