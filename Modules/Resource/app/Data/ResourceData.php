<?php

namespace Modules\Resource\DTO;

use Spatie\LaravelData\Data;

class ResourceData extends Data
{
    public function __construct(
        public string $name,
        public string $type,
        public ?string $description = null
    ) {}
}
