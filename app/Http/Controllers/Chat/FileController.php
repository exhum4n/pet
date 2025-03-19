<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Http\Requests\Chat\File\ShowRequest;
use App\Services\Chat\FileServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class FileController extends Controller
{
    public function __construct(private readonly FileServiceInterface $service)
    {
    }

    public function show(ShowRequest $request): JsonResponse
    {
        return response()->json([
            'id' => $request->file_id,
            'url' => $this->service->getFileUrl($request->gamer, $request->file)
        ]);
    }
}
