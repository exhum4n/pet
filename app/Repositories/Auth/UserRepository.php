<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Exceptions\EntityNotFoundException;
use App\Models\Auth\User;
use App\Models\Model;
use App\Repositories\EloquentRepository;

/**
 * @method User update(Model|User $model, array $data)
 * @method User create(array $data)
 */
class UserRepository extends EloquentRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getByEmailOrFail(string $email): User
    {
        $user = $this->getByEmail($email);
        if ($user === null) {
            throw new EntityNotFoundException();
        }

        return $user;
    }

    public function getByEmail(string $email): User|null
    {
        return $this->getFirst(['email' => $email]);
    }

    protected function getModel(): string
    {
        return User::class;
    }
}
