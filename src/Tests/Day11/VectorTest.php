<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day11;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day11\Vector;

class VectorTest extends TestCase
{
    /**
     * @var Vector
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Vector();
    }

    /**
     * @dataProvider getMoveOneStepTowardsOriginExamples
     *
     * @param array $positionBefore
     * @param array $positionAfter
     */
    public function testMoveOneStepTowardsOrigin(array $positionBefore, array $positionAfter): void
    {
        $this->subject->setPosition($positionBefore[0], $positionBefore[1]);
        $this->subject->moveOneStepTowardsOrigin();

        $this->assertEquals($positionAfter, $this->subject->getPosition());
    }

    public function getMoveOneStepTowardsOriginExamples(): array
    {
        return [
            [[1, 1], [0, 0]],
            [[0, 2], [0, 0]],
            [[0, -2], [0, 0]],
            [[-1, -1], [0, 0]],
            [[-1, 1], [0, 0]],
            [[1, -1], [0, 0]],
        ];
    }
}
