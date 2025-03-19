<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\FormRequest;

/**
 * @property int|null $page
 * @property int|null $per_page
 */
final class CompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
