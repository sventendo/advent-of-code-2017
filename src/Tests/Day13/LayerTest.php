<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day13;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day13\Layer;

class LayerTest extends TestCase
{
    /**
     * @var Layer
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Layer();
    }

    /**
     * @dataProvider getGetPositionAtBeginningOfPicoSecondExamples
     *
     * @param int $picoSecond
     * @param int $range
     * @param int $position
     * @param int $delay
     */
    public function testGetPositionAtBeginningOfPicoSecond(int $picoSecond, int $range, int $position, int $delay): void
    {
        $this->subject->setRange($range);
        $this->assertEquals($position, $this->subject->getPositionAtBeginningOfPicoSecond($picoSecond, $delay));
    }

    public function getGetPositionAtBeginningOfPicoSecondExamples(): array
    {
        return [
            [0, 4, 0, 0],
            [0, 4, 1, 1],
            [1, 4, 1, 0],
            [6, 4, 0, 0],
            [10, 4, 2, 0],
            [16, 4, 2, 0],
        ];
    }
}
