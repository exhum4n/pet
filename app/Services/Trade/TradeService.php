<?php

declare(strict_types=1);

namespace App\Services\Trade;

use App\Enums\Chat\ChatStatus;
use App\Enums\Chat\ChatType;
use App\Enums\Chat\MemberRole;
use App\Enums\Trade\OfferStatus;
use App\Jobs\Trade\OfferAcceptedJob;
use App\Jobs\Trade\OfferCreatedJob;
use App\Jobs\Trade\OfferRejectedJob;
use App\Models\Gamer\Gamer;
use App\Models\Gamer\Item;
use App\Models\Trade\Offer;
use App\Repositories\Gamer\ItemRepository;
use App\Repositories\Trade\OfferRepository;
use App\Services\Chat\ChatServiceInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

final readonly class TradeService implements TradeServiceInterface
{
    use DispatchesJobs;

    public function __construct(public ItemRepository $items, public OfferRepository $offers, private ChatServiceInterface $chatService)
    {
    }

    public function create(Gamer $gamer, Item $item): Offer
    {
        return $this->offers->executeTransaction(function () use ($gamer, $item): Offer {
            $offer = $this->offers->firstOrCreate([
                'buyer_id' => $gamer->id,
                'seller_id' => $item->gamer_id,
                'item_id' => $item->id,
                'status' => OfferStatus::waiting->name,
            ]);

            $this->dispatch(new OfferCreatedJob($offer));

            return $offer;
        });
    }

    public function accept(Offer $offer): void
    {
        if ($offer->status !== OfferStatus::waiting->name) {
            return;
        }

        $this->offers->executeTransaction(function () use ($offer): void {
            $offer = $this->offers->update($offer, [
                'status' => OfferStatus::accepted->name
            ]);

            $chat = $this->chatService->chats->create([
                'type' => ChatType::offer->name,
                'status' => ChatStatus::active->name,
                'subject_id' => $offer->id,
                'name' => __('chat.deal_name') . ' ' . now(),
            ]);

            $this->chatService->members->create([
                'chat_id' => $chat->id,
                'gamer_id' => $offer->buyer_id,
                'role' => MemberRole::buyer->name
            ]);

            $this->chatService->members->create([
                'chat_id' => $chat->id,
                'gamer_id' => $offer->seller_id,
                'role' => MemberRole::seller->name
            ]);

            $this->dispatch(new OfferAcceptedJob($offer));
        });
    }

    public function reject(Offer $offer): void
    {
        if ($offer->status !== OfferStatus::waiting->name) {
            return;
        }

        $this->offers->executeTransaction(function () use ($offer): void {
            $offer = $this->offers->update($offer, [
                'status' => OfferStatus::rejected->name
            ]);

            $this->dispatch(new OfferRejectedJob($offer));
        });
    }
}
