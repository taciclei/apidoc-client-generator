<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator\Builder;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Components;
use ApiPlatform\Core\OpenApi\Model\MediaType;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\Response as ModelResponse;
use Faker\Generator as FakerGenerator;
use Symfony\Component\HttpFoundation\Response;

class ResponseBuilder implements ResponseBuilderInterface
{
    private FakerGenerator $fakerGenerator;

    private OpenApiFactoryInterface $openApiFactory;

    private Components $components;

    private array $apidocTestsGeneratorConfigMarkTestSkipped;

    /**
     * RequestBodyBuilder constructor.
     */
    public function __construct(FakerGenerator $fakerGenerator, OpenApiFactoryInterface $openApiFactory, array $apidocTestsGeneratorConfigMarkTestSkipped)
    {
        $this->fakerGenerator = $fakerGenerator;
        $this->apidocTestsGeneratorConfigMarkTestSkipped = $apidocTestsGeneratorConfigMarkTestSkipped;
        $this->components = $openApiFactory->__invoke()->getComponents();
    }

    public function getJsonSchema(Operation $operation, $codeResponse): ?string
    {
        /** @var \ArrayObject $properties */
        $schema = $this->getSchema($operation, $codeResponse);
        if (null !== $schema) {
            $typeSchema = $this->components->getSchemas()->offsetGet($schema);

            return json_encode($typeSchema);
        }

        return null;
    }

    public function getSchema(Operation $operation, int $responseCode = Response::HTTP_OK, string $type = 'application/ld+json'): ?string
    {
        /** @var ModelResponse $response */
        if (array_key_exists($responseCode, $operation->getResponses())) {
            $response = $operation->getResponses()[$responseCode];
            /** @var MediaType $media */
            if (null !== $response->getContent()) {
                if ($response->getContent()->offsetExists($type)) {
                    $media = $response->getContent()->offsetGet($type);
                    if ($media->getSchema()->offsetExists('$ref')) {
                        $schema = explode('/', $media->getSchema()->offsetGet('$ref'));

                        return end($schema);
                    }
                }
            }
        }

        return null;
    }
}
