<?php

declare(strict_types=1);

namespace App\Http\Controllers\Gamer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gamer\Auth\IndexRequest;
use App\Http\Resources\Gamer\GamerResource;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(IndexRequest $request)
    {
        return app(GamerResource::class, [
            'resource' => $request->gamer
        ]);
    }
}
