<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\Token\IndexRequest;
use App\Http\Resources\Chat\TokenResource;
use App\Services\Chat\TokenServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class TokenController extends Controller
{
    public function __construct(private readonly TokenServiceInterface $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function index(IndexRequest $request): JsonResource
    {
        return app(TokenResource::class, [
            'resource' => $this->service->getToken($request->gamer->id)
        ]);
    }
}
