<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\Models\Gamer\Gamer;
use Illuminate\Http\UploadedFile;

interface AvatarServiceInterface
{
    public function refresh(Gamer $gamer, UploadedFile $file): string;
}
