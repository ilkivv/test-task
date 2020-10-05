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
        $rating[] = $rating_value;
        $rating = $this->getJsonFromArray($rating);

        $response = $user->addOrUpdateRatingByUser($lesson_id, $rating);

        return new JsonResponse(['success' => $response], 200);
    }
}
