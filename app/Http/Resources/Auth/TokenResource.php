<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\JsonResource;
use Illuminate\Http\Request;

/**
 * @property string $token
 */
class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'Bearer',
            'token' => $this->resource
        ];
    }
}
