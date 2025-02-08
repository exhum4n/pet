<?php

declare(strict_types=1);

namespace App\Repositories\Gamer;

use App\Models\Auth\User;
use App\Models\Gamer\Gamer;
use App\Exceptions\EntityNotFoundException;
use App\Repositories\EloquentRepository;

class GamerRepository extends EloquentRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getByUserOrFail(User $user): Gamer
    {
        $gamer = $this->getByUser($user);
        if ($gamer === null) {
            throw new EntityNotFoundException();
        }

        return $gamer;
    }

    public function getByUser(User $user): Gamer|null
    {
        return $this->getFirst(['user_id' => $user->id]);
    }

    protected function getModel(): string
    {
        return Gamer::class;
    }
}
