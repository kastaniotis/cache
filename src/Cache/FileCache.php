<?php

namespace Iconic\Cache;

use Iconic\Assert\Assert;
use Iconic\Result\Result;

class FileCache
{
    public static function get(string $directory, string $fileName, string $fileExtension, FileCreatorInterface $creator, string $contents): Result
    {
        Assert::that(! empty($fileName), 'error.filename.empty');
        Assert::that(! empty($directory), 'error.directory.empty');

        $filePath = "$directory/$fileName.$fileExtension";

        if (! is_file($filePath)) {
            $result = $creator->createFile($contents, $directory, $fileName, $fileExtension);
            if ($result->wasNotSuccessful()) {
                return Result::ERROR($result->getErrorMessage());
            } else {
                Assert::that(is_file($filePath), "error.creator.failed - File: $filePath");
                return Result::OK($result->getString());
            }
        } else {
            return Result::OK($filePath);
        }
    }
}
