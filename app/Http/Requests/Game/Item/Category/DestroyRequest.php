<?php

declare(strict_types=1);

namespace App\Http\Requests\Game\Item\Category;

use App\Http\Requests\FormRequest;
use App\Models\Game\Item\Category;
use App\Services\Game\Item\CategoryService;

final class DestroyRequest extends FormRequest
{
    public Category $category;

    public function rules(): array
    {
        return [
            'category' => [
                'required',
                'uuid'
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->category = app(CategoryService::class)->categories->getByIdOrFail($data['category']);
    }
}
