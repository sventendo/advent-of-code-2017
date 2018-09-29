<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day14;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day14\Row;
use Sventendo\AdventOfCode2017\Day\Day14\Vector;

class RowTest extends TestCase
{
    /**
     * @var Row
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Row(0);
    }

    public function testGetFirstSquareWithGroup(): void
    {
        $this->subject->setValuesFromString('0010');

        $this->assertEquals(new Vector(2, 0), $this->subject->getFirstSquareWithGroup(''));
    }
}
