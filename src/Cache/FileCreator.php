<?php

namespace Iconic\Cache;

use Iconic\Result\Result;

interface FileCreator {
    public function createFile(string $text, string $directory, string $filename, string $fileExtension): Result;
}