<?php

declare(strict_types=1);

namespace App\Repositories\Chat;

use App\Models\Chat\Member;
use App\Repositories\EloquentRepository;

class MemberRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Member::class;
    }
}
