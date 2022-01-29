<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\Builder;

use ApiPlatform\Core\OpenApi\Model\Operation;

interface ResponseBuilderInterface
{
    public function getJsonSchema(Operation $operation, int $codeResponse): ?string;
}
