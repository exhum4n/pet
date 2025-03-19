<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\Registration\AttemptRequest;
use App\Http\Requests\Auth\Registration\CompleteRequest;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegistrationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Code;

final class RegistrationController extends Controller
{
    public function __construct(private readonly RegistrationServiceInterface $service)
    {
    }

    public function attempt(AttemptRequest $request): Response
    {
        $this->service->attempt($request->email);

        return response(status: Code::HTTP_NO_CONTENT);
    }

    public function register(CompleteRequest $request): JsonResponse
    {
        $user = $this->service->complete($request->email, $request->password, $request->code);

        return response()->json([
            'type' => 'Bearer',
            'token' => $user->createToken('access_token')->plainTextToken
        ]);
    }
}
