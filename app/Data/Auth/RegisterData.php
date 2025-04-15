<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Data;

class RegisterData extends Data
{
    public function __construct(
        public string $name,
        #[Email]
        public string $email,
        #[Min(8), Confirmed]
        public string $password,
    ) {
    }
}
