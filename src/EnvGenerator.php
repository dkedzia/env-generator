<?php

namespace Dkedzia\EnvGenerator;

readonly class EnvGenerator
{
    public function __construct(private EnvFileHandler $envFileHandler)
    {
    }

    public function generate(EnvDefinition $envDefinition): void
    {
        foreach ($envDefinition->getDefinition() as $key => $value) {
            $this->envFileHandler->writeLineToFile("{$key}={$value}\n");
        }
    }
}
