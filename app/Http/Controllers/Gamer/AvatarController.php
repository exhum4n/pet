<?php

declare(strict_types=1);

namespace App\Http\Controllers\Gamer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gamer\Avatar\UpdateRequest;
use App\Services\Gamer\AvatarService;
use Illuminate\Http\JsonResponse;

class AvatarController extends Controller
{
    public function __construct(private readonly AvatarService $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        return response()->json([
            'path' => $this->service->refresh($request->gamer, $request->avatar)
        ]);
    }
}
