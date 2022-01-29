<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\Builder;

use PhpJit\ApidocClientGenerator\GeneratedTestClassDto;

interface MarkSkippedBuilderInterface
{
    public function getApidocTestsGeneratorConfigMarkTestSkipped(): array;

    public function setApidocTestsGeneratorConfigMarkTestSkipped(array $apidocTestsGeneratorConfigMarkTestSkipped): void;

    public function write(GeneratedTestClassDto $generatedTestClassDto, string $message);
}
