<?php

namespace Iconic\Tests\Cache;

use Iconic\Assert\AssertError;
use Iconic\Cache\FileCache;
use Iconic\Cache\FileCreator;
use Iconic\Result\Result;
use PHPUnit\Framework\TestCase;

class FileCacheTest extends TestCase {
    public function testFileCacheFileExists(): void
    {
        $creator = $this->createMock(FileCreator::class);
        $creator->expects($this->never())->method('createFile');
        $result = FileCache::get('./', 'README', 'md', $creator, 'test');
        $this->assertTrue($result->wasSuccessful());
    }

    public function testFileCacheFileDoesNotExist(): void
    {
        $creator = $this->createMock(FileCreator::class);
        $creator->expects($this->once())->method('createFile')->willReturn(Result::OK(''));
        // Because the mock did not actually create a file
        $this->expectException(AssertError::class);
        FileCache::get('./ ', 'README2', 'md', $creator, 'test');
    }
}
