<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Services\Auth\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Code;

final class AuthController extends Controller
{
    public function __construct(private readonly AuthService $service)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): TokenResource
    {
        $user = $this->service->byPassword($request->user, $request->password);

        return new TokenResource($user->createToken('access_token')->plainTextToken);
    }

    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response(status: Code::HTTP_NO_CONTENT);
    }

    public function logoutAll(Request $request): Response
    {
        $request->user()->tokens()->delete();

        return response(status: Code::HTTP_NO_CONTENT);
    }
}
