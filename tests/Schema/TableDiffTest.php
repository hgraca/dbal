<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Tests\Schema;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Schema\Identifier;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\TableDiff;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TableDiffTest extends TestCase
{
    /** @var AbstractPlatform&MockObject */
    private AbstractPlatform $platform;

    public function setUp(): void
    {
        $this->platform = $this->createMock(AbstractPlatform::class);
    }

    public function testReturnsName(): void
    {
        $tableDiff = new TableDiff('foo');

        self::assertEquals(new Identifier('foo'), $tableDiff->getName($this->platform));
    }

    public function testPrefersNameFromTableObject(): void
    {
        $tableMock = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->getMock();

        $tableDiff            = new TableDiff('foo');
        $tableDiff->fromTable = $tableMock;

        $tableMock->expects(self::once())
            ->method('getQuotedName')
            ->with($this->platform)
            ->willReturn('foo');

        self::assertEquals(new Identifier('foo'), $tableDiff->getName($this->platform));
    }
}
