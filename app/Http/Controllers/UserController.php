<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function user(UserRepository $userRepository)
    {
        return response()->json($userRepository->authUser());
    }
}