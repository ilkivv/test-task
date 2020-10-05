<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use App\Traits\ArrayJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    use ArrayJson;

    public function getStatistics(User $userModel, Lesson $lessonModel, $class)
    {
        $students = $userModel->getAllStudents();

        $students_by_class = [];
        $average = 0;
        $count_students = 0;
        foreach ($students as $student) {
            foreach ($student->attributes_db as $attribute) {
                if ($attribute->slug === 'class' && $attribute->pivot->value == $class){
                    $students_by_class[] = $student;
                }
            }
        }

        foreach ($students_by_class as $student) {
            foreach ($student->lessons as $lesson) {
                if ($lesson->pivot->rating !== null){
                    $rating = $this->getArrayFromJson($lesson->pivot->rating);
                    $average += array_sum($rating) / count($rating);
                    $count_students++;
                }
            }
        }
        if ($count_students < 1) return new JsonResponse(['error' => 'Не найдено ни одного ученика  с оценками в ' . $class . '-ом классе'], 200);
        $average = round($average / $count_students, 1);

        return new JsonResponse(['result' => 'В ' . $class . '-ом классе средний балл - ' . $average], 200);
    }
    
    public function addRating(Request $request, User $userModel, Lesson $lessonModel)
    {
        $params = $request->all();
        $user_id = (int) $params['user_id'];
        $lesson_id = (int) $params['lesson_id'];
        $rating_value = (int) $params['rating'];

        $user = $userModel->getUserById($user_id);
        $rating = $lessonModel->getLessonByIdFromCollection($user->lessons, $lesson_id);
        $rating = $this->getArrayFromJson($rating);
        $rating[] = $rating_value;
        $rating = $this->getJsonFromArray($rating);

        $response = $user->addOrUpdateRatingByUser($lesson_id, $rating);

        return new JsonResponse(['success' => $response], 200);
    }

    public function updateRating(Request $request, User $userModel, Lesson $lessonModel)
    {
        $params = $request->all();
        $user_id = (int) $params['user_id'];
        $lesson_id = (int) $params['lesson_id'];
        $rating_value = (int) $params['rating_value'];
        $rating_key = (int) $params['rating_key'];

        $user = $userModel->getUserById($user_id);
        $rating = $lessonModel->getLessonByIdFromCollection($user->lessons, $lesson_id);
        $rating = $this->getArrayFromJson($rating);

        if (!isset($rating[$rating_key])) return new JsonResponse(['error' => "Оценки с таким ключом не существует"], 200);

        $rating[$rating_key - 1] = $rating_value;
        $rating = $this->getJsonFromArray($rating);

        $response = $user->addOrUpdateRatingByUser($lesson_id, $rating);

        return new JsonResponse(['success' => $response], 200);
    }

    public function deleteRating(Request $request, User $userModel, Lesson $lessonModel)
    {
        $params = $request->all();
        $user_id = (int) $params['user_id'];
        $lesson_id = (int) $params['lesson_id'];
        $rating_key = (int) $params['rating_key'];

        $user = $userModel->getUserById($user_id);
        $rating = $lessonModel->getLessonByIdFromCollection($user->lessons, $lesson_id);
        $rating = $this->getArrayFromJson($rating);

        if (!isset($rating[$rating_key])) return new JsonResponse(['error' => "Оценки с таким ключом не существует"], 200);

        unset($rating[$rating_key]);

        $rating = $this->getJsonFromArray($rating);

        $response = $user->addOrUpdateRatingByUser($lesson_id, $rating);

        return new JsonResponse(['success' => $response], 200);
    }
}
