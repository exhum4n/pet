<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\Item\Category\DestroyRequest;
use App\Http\Requests\Game\Item\Category\IndexRequest;
use App\Http\Requests\Game\Item\Category\StoreRequest;
use App\Http\Resources\Game\Item\CategoryResource;
use App\Services\Game\Item\CategoryService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Code;

final class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $service)
    {
        $this->middleware('auth:sanctum')->only([
            'store', 'destroy',
        ]);
    }

    public function index(IndexRequest $request): JsonResource
    {
        return app(CategoryResource::class, [
            'resource' => $this->service->getByGame($request->game)
        ]);
    }

    public function store(StoreRequest $request): JsonResource
    {
        return app(CategoryResource::class, [
            'resource' => $this->service->create($request->game, $request->name)
        ]);
    }

    public function destroy(DestroyRequest $request): Response
    {
        $this->service->categories->deleteByModel($request->category);

        return response(status: Code::HTTP_NO_CONTENT);
    }
}
