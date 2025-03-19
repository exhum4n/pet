<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\Password\AttemptRequest;
use App\Http\Requests\Auth\Password\ChangeRequest;
use App\Http\Controllers\Controller;
use App\Services\Auth\PasswordServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Code;

final class PasswordController extends Controller
{
    public function __construct(private readonly PasswordServiceInterface $service)
    {
    }

    public function attempt(AttemptRequest $request): Response
    {
        $this->service->sendRequest($request->email);

        return response(Code::HTTP_NO_CONTENT);
    }

    public function change(ChangeRequest $request): Response
    {
        $this->service->change($request->user, $request->code, $request->password);

        return response(Code::HTTP_NO_CONTENT);
    }
}
