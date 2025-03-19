<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\Models\Chat\Chat;
use App\Models\Chat\File;
use App\Models\Chat\Message;
use App\Models\Gamer\Gamer;
use App\Repositories\Chat\FileRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FileService implements FileServiceInterface
{
    use DispatchesJobs;

    public function __construct(private readonly FileRepository $files)
    {
    }

    public function uploadBase64File(Gamer $gamer, Message $message, string $base64File, ?string $filename = null): string
    {
        return $this->files->executeTransaction(function () use($message, $base64File, $filename): string {
            return '';
        });
    }

    /**
     * @throws AuthorizationException
     */
    public function getFileUrl(Gamer $gamer, File $file): string
    {
        if ($this->isGamerInChat($gamer, $file->message->chat) === false) {
            throw new AuthorizationException();
        }

        return '';
    }

    private function isGamerInChat(Gamer $gamer, Chat $chat): bool
    {
        return (bool) $chat->gamers->where('id', $gamer->id)->first();
    }
}
