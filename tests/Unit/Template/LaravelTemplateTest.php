<?php

namespace Test\Unit\Template;

use Dkedzia\EnvGenerator\EnvDefinition;
use Dkedzia\EnvGenerator\Template\EnvTemplate;
use Dkedzia\EnvGenerator\Template\LaravelTemplate;
use PHPUnit\Framework\TestCase;

class LaravelTemplateTest extends TestCase
{
    private LaravelTemplate $laravelTemplate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->laravelTemplate = new LaravelTemplate();
    }

    /** @test */
    public function shouldBeAnInstanceOfEnvDefinition(): void
    {
        $this->assertInstanceOf(EnvDefinition::class, $this->laravelTemplate);
    }

    /** @test */
    public function shouldBeAnInstanceOfEnvTemplate(): void
    {
        $this->assertInstanceOf(EnvTemplate::class, $this->laravelTemplate);
    }
}
