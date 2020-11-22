<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Auth;
use Hash;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
                'access_token' => $token,
                'status' => 'success'
            ], 200)->header('Authorization', $token);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return response()->json([
            'status' => 'success'
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        $user = User::find(auth()->user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()->json([
                'status' => 'success'
            ], 200)->header('Authorization', $token);
        }

        return response()->json([
            'error' => 'refresh_token_error'
        ], 400);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
