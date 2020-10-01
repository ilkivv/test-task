<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    /**
     * login API
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return new JsonResponse($validator->errors(), 417);

        $credentials = $request->only(['name', 'password']);

        if (Auth::attempt($credentials, true)) {

            $user = Auth::user();
            $success['token'] = $user->createToken('test-client')->accessToken;
            $success['id'] = $user->id;

            return new JsonResponse(['success' => $success], 200);
        }
        else {
            return new JsonResponse(['error' => 'Ошибка ввода данных'], 401);
        }
    }

    /**
     * register API
     *
     * @param Request $request
     * @param User $userModel
     * @return JsonResponse
     */
    public function register(Request $request, User $userModel)
    {

        $params = $request->all();
        $validator = Validator::make($params, [
            'name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) return new JsonResponse($validator->errors(), 417);

        $user = $userModel->getUser($params['name']);

        if ($user) return new JsonResponse(["error" => "Такой пользователь уже зарегистрирован"], 417);

        $params['password'] = bcrypt($params['password']);

        $user = $userModel->createUser($params);

        $success['name'] = $user['name'];
        $success['token'] = $user->createToken('test-client')->accessToken;
        return new JsonResponse(['success' => $success], 200);
    }

    public function logout(){

        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return new JsonResponse(['success' =>'Вы успешно вышли'],200);
        }else{
            return new JsonResponse(['error' =>'Вы уже вышли'], 500);
        }
    }
}
