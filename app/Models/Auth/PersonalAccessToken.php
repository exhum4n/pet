<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Sanctum\PersonalAccessToken as Token;

class PersonalAccessToken extends Token
{
    use HasUuids;

    protected $table = 'auth.personal_access_tokens';

    public $incrementing = false;
    protected $keyType = 'string';
}
