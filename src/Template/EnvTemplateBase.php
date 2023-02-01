<?php

namespace Dkedzia\EnvGenerator\Template;

use Dkedzia\EnvGenerator\EnvDefinition;

abstract class EnvTemplateBase implements EnvDefinition, EnvTemplate
{
    protected array $variables;

    public function __construct(array $override = [])
    {
        $this->variables = array_merge($this->variables, $override);
    }

    public function getDefinition(): array
    {
        return $this->variables;
    }

    public function setVariable(string $key, string $value): EnvTemplate
    {
        $this->variables[$key] = $value;
        return $this;
    }

    public function purgeVariable(string $key): EnvTemplate
    {
        unset($this->variables[$key]);
        return $this;
    }
}
