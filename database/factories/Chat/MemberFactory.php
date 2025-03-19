<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Database\Factories\Chat;

use App\Enums\Chat\MemberRole;
use App\Models\Chat\Chat;
use App\Models\Chat\Member;
use App\Models\Gamer\Gamer;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid,
            'chat_id' => Chat::factory()->create()->id,
            'gamer_id' => Gamer::factory()->create()->id,
            'role' => fake()->randomElement(MemberRole::cases())->name,
        ];
    }
}
