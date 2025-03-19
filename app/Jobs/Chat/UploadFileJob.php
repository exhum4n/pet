<?php

declare(strict_types=1);

namespace App\Jobs\Chat;

use App\Jobs\AbstractJob;
use App\Models\Chat\Message;
use App\Models\Gamer\Gamer;
use App\Services\Chat\FileServiceInterface;

final class UploadFileJob extends AbstractJob
{
    public function __construct(
        private readonly Gamer $gamer,
        private readonly Message $message,
        private readonly string $base64File,
        private readonly ?string $filename = null
    )
    {
    }

    public function handle(): void
    {
        $this->makeFileService()->uploadBase64File($this->gamer, $this->message, $this?->base64File, $this?->filename);
    }

    private function makeFileService(): FileServiceInterface
    {
        return app(FileServiceInterface::class);
    }
}
