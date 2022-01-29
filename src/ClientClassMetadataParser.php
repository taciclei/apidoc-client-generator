<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator;

use function array_unique;
use Doctrine\Common\Annotations\TokenParser;
use Doctrine\Inflector\Inflector;
use PHPUnit\Framework\MockObject\MockObject;

class ClientClassMetadataParser
{
    public const DEPENDENCY = 'dependency';

    public const NORMAL = 'normal';

    public const SUT = 'sut';

    /** @var string */
    private $classShortName;

    /** @var string */
    private $classCamelCaseName;

    public function __construct(?Inflector $inflector = null)
    {
        $this->inflector = $inflector ?? InflectorFactory::createEnglishInflector();
    }

    private function getClassContets(): string
    {
        return file_get_contents($this->reflectionClass->getFileName());
    }

    private function generateUseStatements(): array
    {
        $useStatements = [];
        $tokenParser = new TokenParser($this->getClassContets());

        while ($token = $tokenParser->next(false)) {
            if ($token[0] === \T_USE) {
                $useStatements = array_merge($useStatements, $tokenParser->parseUseStatement());
            }
        }
        $useStatements[] = MockObject::class;

        $useStatements = array_unique($useStatements);

        return $useStatements;
    }

    /**
     * @return mixed
     */
    private function generateTypeRandomValue(string $type)
    {
        switch ($type) {
            case 'array':
                return [];
            case 'bool':
                return true;
            case 'float':
                return 1.0;
            case 'int':
                return 1;
            case 'string':
                return '';
        }

        return '';
    }
}
