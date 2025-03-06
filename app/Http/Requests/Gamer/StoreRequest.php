<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer;

use App\DataObjects\GamerData;
use App\Enums\Gamer\Gender;
use App\Enums\Language;
use App\Http\Requests\FormRequest;

/**
 * @property string $username
 * @property string $avatar
 * @property string $gender
 * @property string $birthday
 */
final class StoreRequest extends FormRequest
{
    public GamerData $data;

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender' => [
                'required',
                'enum:' . Gender::class,
            ],
            'birthday' => [
                'required',
                'date_format:Y.m.d'
            ],
            'timezone' => [
                'required',
                'timezone:all',
            ],
            'languages' => [
                'required',
                'array',
                'min:1',
            ],
            'languages.*' => [
                'required',
                'enum:' . Language::class,
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
         $this->data = new GamerData($data);
    }
}
