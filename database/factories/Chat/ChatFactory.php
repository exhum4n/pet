<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Database\Factories\Chat;

use App\Enums\Chat\ChatStatus;
use App\Enums\Chat\ChatType;
use App\Models\Chat\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid,
            'type' => fake()->randomElement(ChatType::cases())->name,
            'status' => fake()->randomElement(ChatStatus::cases())->name,
            'name' => fake()->colorName,
            'subject_id' => fake()->uuid,
        ];
    }
}
