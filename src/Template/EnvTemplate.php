<?php

namespace Dkedzia\EnvGenerator\Template;

interface EnvTemplate
{
    public function setVariable(string $key, string $value): self;

    public function purgeVariable(string $key): self;
}
