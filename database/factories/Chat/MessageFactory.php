<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Database\Factories\Chat;

use App\Enums\Chat\MessageType;
use App\Models\Chat\Chat;
use App\Models\Chat\Member;
use App\Models\Chat\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid,
            'chat_id' => Chat::factory()->create()->id,
            'member_id' => Member::factory()->create()->id,
            'type' => fake()->randomElement(MessageType::cases())->id,
            'content' => fake()->text
        ];
    }
}
