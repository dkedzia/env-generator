<?php

namespace Test\Unit;

use Dkedzia\EnvGenerator\EnvDefinition;
use Dkedzia\EnvGenerator\EnvFileHandler;
use Dkedzia\EnvGenerator\EnvGenerator;
use PHPUnit\Framework\TestCase;

class EnvGeneratorTest extends TestCase
{
    /** @test */
    public function shouldGenerateEnvFile(): void
    {
        // given
        $envDefinition = $this->createMock(EnvDefinition::class);
        $envDefinition->expects($this->once())
            ->method('getDefinition')
            ->willReturn([
                'TEST_KEY' => 'TEST_VALUE',
                'TEST_KEY2' => 'TEST_VALUE2',
            ]);

        $envFileHandler = $this->getMockBuilder(EnvFileHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
        $envFileHandler
            ->expects($this->exactly(2))
            ->method('writeLineToFile')
            ->withConsecutive(
                [$this->equalTo("TEST_KEY=TEST_VALUE\n")],
                [$this->equalTo("TEST_KEY2=TEST_VALUE2\n")],
            );

        $envGenerator = new EnvGenerator($envFileHandler);

        // when
        $envGenerator->generate($envDefinition);
    }
}
