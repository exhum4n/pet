<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\DataObjects\GamerData;
use App\Exceptions\ActionNotAllowed;
use App\Models\Gamer\Gamer;
use App\Repositories\Gamer\GamerRepository;
use App\Models\Auth\User;

final readonly class GamerService
{
    public function __construct(public GamerRepository $gamers)
    {
    }

    /**
     * @throws ActionNotAllowed
     */
    public function register(User $user, GamerData $data): Gamer
    {
        if ($this->gamers->getByUser($user)) {
            throw new ActionNotAllowed('gamer_already_registered');
        }

        return $this->gamers->create([
            'user_id' => $user->id,
            'username' => $data->username,
            'tag' => $this->makeTag(),
            'gender' => $data->gender,
            'birthday' => $data->birthday,
        ]);
    }

    protected function makeTag(): int
    {
        return rand(1000, 9999);
    }
}
