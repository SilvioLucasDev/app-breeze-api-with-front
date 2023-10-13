<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $user = auth()->user();
        $user->tokens()->delete();
        if ($this->isInternal($request)) {
            $request->session()->regenerate();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $user->createToken('Login_token')->plainTextToken,
                'name' => $user->name,
            ],
            'message' => 'User logged in!',
        ], 200);
    }

    public function refresh(Request $request): JsonResponse
    {
        $refreshToken = $request->header('Authorization');
        if (! $refreshToken) {
            return response()->json(['success' => false, 'message' => 'Invalid token!'], 401);
        }
        $refreshToken = explode(' ', $refreshToken)[1];
        $token = PersonalAccessToken::findToken($refreshToken);
        if (! $token) {
            return response()->json(['success' => false, 'message' => 'Invalid token!'], 401);
        }
        $user = $token->tokenable;
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $user->createToken('Refresh_token')->plainTextToken,
                'name' => $user->name,
            ],
            'message' => 'User logged in!',
        ], 200);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $request->user(),
            ],
            'message' => 'Me!',
        ], 200);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        if ($this->isInternal($request)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
        }

        return response()->json(['success' => true, 'message' => 'User logged out!'], 200);
    }

    private function isInternal(Request $request): string
    {
        $client = $request->header('Client');
        if (! empty($client) && $client === 'external') {
            return false;
        }

        return true;
    }
}
