<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\Configuration;

interface ComposerConfigurationReaderInterface
{
    public function createConfiguration(?string $path = null): Configuration;
}
