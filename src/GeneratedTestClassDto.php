<?php

declare(strict_types=1);

namespace PhpJit\ApidocClientGenerator;

class GeneratedTestClassDto
{
    public ?string $route = null;

    public ?string $method = null;

    public ?string $className = null;

    public ?string $testClassName = null;

    public ?string $code = null;

    public ?string $jsonSchema = null;

    public ?string $body = null;

    public ?string $bodInvalid = null;

    public function __construct(?string $route, ?string $methode)
    {
        $this->route = $route;
        $this->method = $methode;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(?string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(?string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setClassName(?string $className): self
    {
        $this->className = $className;

        return $this;
    }

    public function getTestClassName(): ?string
    {
        return $this->testClassName;
    }

    public function setTestClassName(?string $testClassName): self
    {
        $this->testClassName = $testClassName;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getJsonSchema(): ?string
    {
        return $this->jsonSchema;
    }

    public function setJsonSchema(?string $jsonSchema): self
    {
        $this->jsonSchema = $jsonSchema;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBodInvalid(): ?string
    {
        return $this->bodInvalid;
    }

    public function setBodInvalid(?string $bodInvalid): self
    {
        $this->bodInvalid = $bodInvalid;

        return $this;
    }
}
