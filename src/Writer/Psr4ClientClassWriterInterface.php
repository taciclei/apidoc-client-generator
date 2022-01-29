<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\Writer;

use PhpJit\ApidocClientGenerator\GeneratedTestClassDto;

interface Psr4ClientClassWriterInterface
{
    public function write(GeneratedTestClassDto $generatedTestClass): string;
}
