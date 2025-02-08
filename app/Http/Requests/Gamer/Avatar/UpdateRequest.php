<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Avatar;

use App\Http\Requests\GamerRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property UploadedFile $avatar
 */
class UpdateRequest extends GamerRequest
{
    public function rules(): array
    {
        return [
            'avatar' => [
                'required',
                'image',
                'mimes:jpeg,png',
                'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ]
        ];
    }
}
