<?php

namespace App\Models;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
 
class PersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $table = 'quo_personal_access_tokens';
}