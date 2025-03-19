<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\Models\Chat\File;
use App\Models\Gamer\Gamer;
use App\Models\Chat\Message;

interface FileServiceInterface
{
    public function uploadBase64File(Gamer $gamer, Message $message, string $base64File, ?string $filename = null): string;
    public function getFileUrl(Gamer $gamer, File $file): string;
}
