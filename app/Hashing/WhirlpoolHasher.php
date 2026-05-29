<?php

namespace App\Hashing;

use Illuminate\Contracts\Hashing\Hasher;

class WhirlpoolHasher implements Hasher
{
    public function make($value, array $options = []): string
    {
        return strtoupper(hash('whirlpool', $value));
    }

    public function check($value, $hashedValue, array $options = []): bool
    {
        return strtoupper(hash('whirlpool', $value)) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = []): bool
    {
        return false;
    }
}
