<?php

namespace App\Http\Controllers\Api;

use App\Actions\SendOTPNotificationAction;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function __invoke(RegistrationRequest $request,SendOTPNotificationAction $sendOTPNotificationAction): JsonResponse
    {
        $data = $request->validated();

        $user = User::create($data);

        $sendOTPNotificationAction->execute($user);

        return response()->json(['message' => 'Verification email sent please check your inbox']);
    }


}
