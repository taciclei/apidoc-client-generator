<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\Builder;

use PhpJit\ApidocClientGenerator\GeneratedTestClassDto;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class MarkSkippedBuilder implements MarkSkippedBuilderInterface
{
    private array $apidocTestsGeneratorConfigMarkTestSkipped;

    private ContainerInterface $container;

    private KernelInterface $kernel;

    public function __construct(
        array $apidocTestsGeneratorConfigMarkTestSkipped,
        ContainerInterface $container,
        KernelInterface $kernel
    )
    {
        $this->apidocTestsGeneratorConfigMarkTestSkipped = $apidocTestsGeneratorConfigMarkTestSkipped;
        $this->container = $container;
        $this->kernel = $kernel;
    }

    public function write(GeneratedTestClassDto $generatedTestClassDto, string $message)
    {
        $code = str_replace('//$this->markTestSkipped();', '$this->markTestSkipped(\'' . $message . '\');', $generatedTestClassDto->getCode());
        $generatedTestClassDto->setCode($code);
        $filePath = $this->kernel->getProjectDir() . '/config/packages/dev/apidoc_tests_generator.yaml';

        $arrayConf = Yaml::parseFile($filePath);
        $param = ['route' => $generatedTestClassDto->getRoute(), 'method' => $generatedTestClassDto->getMethod()];
        $arrayConf['apidoc_tests_generator']['markTestSkipped'][] = $param;

        $yaml = Yaml::dump($arrayConf, 2, 4, Yaml::DUMP_OBJECT);

        file_put_contents($filePath, $yaml);
    }

    public function getApidocTestsGeneratorConfigMarkTestSkipped(): array
    {
        return $this->apidocTestsGeneratorConfigMarkTestSkipped;
    }

    public function setApidocTestsGeneratorConfigMarkTestSkipped(array $apidocTestsGeneratorConfigMarkTestSkipped): void
    {
        $this->apidocTestsGeneratorConfigMarkTestSkipped = $apidocTestsGeneratorConfigMarkTestSkipped;
    }
}
