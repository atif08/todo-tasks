<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Domain\Users\Actions\SendOTPNotificationAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class TwoFactorAuthController extends Controller
{

    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            "code" => "required"
        ]);

        $user = User::where('code', $request->code)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid verification code.'], 400);
        }

        if ($user->email_verified_at !== null) {
            return response()->json(['message' => 'Email already verified.'], 400);
        }

        $user->email_verified_at = now();
        $user->save();

        $user['token'] = $user->createToken($user->email)->plainTextToken;

        return response()->json($user);
    }

}
