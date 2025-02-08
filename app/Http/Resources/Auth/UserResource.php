<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\JsonResource;
use App\Models\Auth\User;
use Illuminate\Http\Request;

/**
 * @property User $resource
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'email' => $this->resource->email,
            'status' => $this->resource->status,
            'registration_date' => $this->resource->created_at->format('Y.m.d H:i:s')
        ];
    }
}
