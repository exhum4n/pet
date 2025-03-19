<?php

declare(strict_types=1);

namespace App\Models\Policies\Trade;

use App\Models\Auth\User;
use App\Models\Policies\Policy;
use App\Models\Trade\Offer;

class OfferPolicy extends Policy
{
    public function accept(User $user, Offer $offer): bool
    {
        return $this->isOwner($user, $offer);
    }

    public function reject(User $user, Offer $offer): bool
    {
        return $this->isOwner($user, $offer);
    }

    private function isOwner(User $user, Offer $offer): bool
    {
        return $user->gamer->id === $offer->item->gamer_id;
    }
}
