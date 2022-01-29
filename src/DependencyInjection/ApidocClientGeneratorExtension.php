<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ApidocClientGeneratorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/Config'));
        $loader->load('Services.php');

        $config = $this->processConfiguration(new Configuration(), $configs);
        $this->setParameters($config, 'apidoc_client_generator', $container);
    }

    private function setParameters(array $parameters, string $base, ContainerBuilder $container): void
    {
        foreach ($parameters as $key => $value) {
            $namespace = $base . '.' . $key;
            $container->setParameter($namespace, $value);

            if (\is_array($value)) {
                $this->setParameters($value, $namespace, $container);
            }
        }
    }
}
