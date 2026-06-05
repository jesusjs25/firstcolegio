<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::paginate(20);

        return response()->json($users);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }
}
