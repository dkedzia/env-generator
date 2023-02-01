<?php

namespace Dkedzia\EnvGenerator;

use Test\Unit\EnvFileHandlerTest;

/** Only for testing purposes */
function fopen(string $filename, string $mode, bool $use_include_path = false, $context = null)
{
    EnvFileHandlerTest::$fOpenFileNamePassed = $filename;
    EnvFileHandlerTest::$fOpenModePassed = $mode;
    return EnvFileHandlerTest::$fOpenResourceToReturn;
}

/** Only for testing purposes */
function fwrite($stream, string $data, ?int $length = null): int|false
{
    EnvFileHandlerTest::$fWriteResourcePassed = $stream;
    EnvFileHandlerTest::$fWriteDataPassed = $data;
    return EnvFileHandlerTest::$fWriteReturn;
}

/** Only for testing purposes */
function fclose($stream): bool
{
    EnvFileHandlerTest::$fCloseResourcePassed = $stream;
    return true;
}

namespace Test\Unit;

use Dkedzia\EnvGenerator\EnvFileException;
use Dkedzia\EnvGenerator\EnvFileHandler;
use PHPUnit\Framework\TestCase;
use stdClass;

class EnvFileHandlerTest extends TestCase
{
    public static string $fOpenFileNamePassed;
    public static string $fOpenModePassed;
    public static mixed $fOpenResourceToReturn;
    public static mixed $fWriteResourcePassed;
    public static mixed $fWriteDataPassed;
    public static int|false $fWriteReturn;
    public static mixed $fCloseResourcePassed;

    /** @test */
    public function shouldOpenAndCloseTheFile(): void
    {
        // given
        self::$fOpenResourceToReturn = $this->createMock(stdClass::class);

        // when
        $envFileHandler = new EnvFileHandler('/.env');
        unset($envFileHandler);

        // then
        $this->assertEquals('/.env', self::$fOpenFileNamePassed);
        $this->assertEquals('w', self::$fOpenModePassed);
        $this->assertEquals(self::$fOpenResourceToReturn, self::$fCloseResourcePassed);
    }

    /** @test */
    public function shouldWriteLinesToTheFile(): void
    {
        // given
        self::$fOpenResourceToReturn = $this->createMock(stdClass::class);
        self::$fWriteReturn = 1;

        // when
        $envFileHandler = new EnvFileHandler('/.env');

        $this->writeLine($envFileHandler, 'KEY=VAL');
        $this->writeLine($envFileHandler, 'KEY2=VAL2');
    }

    private function writeLine(EnvFileHandler $envFileHandler, string $lineToWrite): void
    {
        $envFileHandler->writeLineToFile($lineToWrite);
        $this->assertEquals(self::$fWriteResourcePassed, self::$fOpenResourceToReturn);
        $this->assertEquals(self::$fWriteDataPassed, $lineToWrite);
    }

    /** @test */
    public function shouldThrowEnvFileExceptionWhenCannotOpenTheFile(): void
    {
        // given
        self::$fOpenResourceToReturn = false;

        // then
        $this->expectException(EnvFileException::class);

        // when
        (new EnvFileHandler('/.env'));
    }
}
