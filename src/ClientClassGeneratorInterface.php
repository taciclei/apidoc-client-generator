<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator;

use ApiPlatform\Core\OpenApi\Model\Components;
use ApiPlatform\Core\OpenApi\Model\PathItem;

interface ClientClassGeneratorInterface
{
    public function generate(array $templateOperation, GeneratedTestClassDto $generatedTestClassDto, PathItem $resource, Components $components): void;

    public function toSnakeCase(string $name): string;

    public function toCamelCase(string $name): string;
}
