<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\Models\Gamer\Gamer;
use App\Repositories\Gamer\GamerRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final readonly class AvatarService
{
    public function __construct(private GamerRepository $gamers)
    {
    }

    public function refresh(Gamer $gamer, UploadedFile $file): string
    {
        $name = $this->makeName($gamer, $file);

        return $this->gamers->executeTransaction(function () use ($gamer, $file, $name) {
            $path = $this->save($file, $name);

            $this->gamers->update($gamer, [
                'avatar_url' => $path
            ]);

            return $path;
        });
    }

    private function save(UploadedFile $file, string $name): string
    {
        $relativePath = Storage::disk('s3')->putFileAs('avatars', $file, $name, 'public');

        return Storage::disk('s3')->url($relativePath);
    }

    private function makeName(Gamer $gamer, UploadedFile $file): string
    {
        return "$gamer->username#$gamer->tag." . $file->getClientOriginalExtension();
    }
}
