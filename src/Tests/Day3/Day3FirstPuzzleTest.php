<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day3;

class Day3FirstPuzzleTest extends TestCase
{
    /**
     * @var Day3
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Day3();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        echo $this->subject->firstPuzzle('277678');
    }

    /**
     * @dataProvider getRingForValueExamples
     *
     * @param int $input
     * @param int $expected
     */
    public function testRingForValue(int $input, int $expected): void
    {
        $this->assertEquals($expected, $this->subject->getRingForValue($input));
    }

    /**
     * @dataProvider getMaxValueForRingExamples
     *
     * @param int $ring
     * @param int $expected
     */
    public function testMaxValueForRing(int $ring, int $expected): void
    {
        $this->assertEquals($expected, $this->subject->getMaxValueForRing($ring));
    }

    /**
     * @dataProvider getLengthOfRingExamples
     *
     * @param int $ring
     * @param int $length
     */
    public function testLengthOfRing(int $ring, int $length): void
    {
        $this->assertEquals($length, $this->subject->getLengthOfRing($ring));
    }

    /**
     * @dataProvider getDistanceFromEdgeCenterExamples
     *
     * @param int $value
     * @param int $distance
     */
    public function testDistanceFromEdgeCenter(int $value, int $distance): void
    {
        $this->assertEquals($distance, $this->subject->getDistanceFromEdgeCenter($value));
    }

    public function getRingForValueExamples(): array
    {
        return [
            [8, 1],
            [9, 1],
            [10, 2],
            [23, 2],
            [25, 2],
            [77, 4],
        ];
    }

    public function getMaxValueForRingExamples(): array
    {
        return [
            [1, 9],
            [2, 25],
            [3, 49],
            [4, 81],
        ];
    }

    public function getLengthOfRingExamples(): array
    {
        return [
            [1, 3],
            [2, 5],
            [3, 7],
        ];
    }

    public function getDistanceFromEdgeCenterExamples(): array
    {
        return [
            [9, 1],
            [24, 1],
            [32, 2],
            [72, 3],
            [65, 4],
        ];
    }
}
