<?php

namespace Modules\Resource\Data;

use Spatie\LaravelData\Data;

class ResourceData extends Data
{
    public function __construct(
        public string $name,
        public string $type,
        public ?string $description = null
    ) {}
}
