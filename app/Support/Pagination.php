<?php

namespace App\Support;

class Pagination
{
    public const DEFAULT_PER_PAGE = 10;
    public const MIN_PER_PAGE = 5;
    public const MAX_PER_PAGE = 50;

    public const PER_PAGE_RULES = [
        'sometimes',
        'integer',
        'min:' . self::MIN_PER_PAGE,
        'max:' . self::MAX_PER_PAGE,
    ];
}
