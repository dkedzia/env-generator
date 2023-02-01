<?php

namespace Dkedzia\EnvGenerator;

class EnvFileHandler
{
    private mixed $resource;

    /**
     * @throws EnvFileException
     */
    public function __construct(string $filePath)
    {
        $resource = fopen($filePath, 'w');
        if ($resource === false) {
            throw new EnvFileException("Could not open the file under path {$filePath} with write permissions");
        }
        $this->resource = $resource;
    }

    public function __destruct()
    {
        fclose($this->resource);
    }

    public function writeLineToFile(string $lineToWrite): static
    {
        fwrite($this->resource, $lineToWrite);
        return $this;
    }
}
