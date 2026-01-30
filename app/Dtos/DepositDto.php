<?php

namespace App\Dtos;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DepositDto extends Data
{
    public function __construct(
        #[Min(100), Max(20000)]
        public int $amount,
    )
    {
    }
}
