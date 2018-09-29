<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day2;

class Day2Test extends TestCase
{
    /**
     * @var Day2
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Day2();
    }

    /**
     * @dataProvider getFirstPuzzleData
     * @doesNotPerformAssertions
     *
     * @param string $input
     */
    public function testFirstPuzzle(string $input): void
    {
        echo $this->subject->firstPuzzle($input);
    }

    /**
     * @dataProvider getSecondPuzzleData
     * @doesNotPerformAssertions
     *
     * @param string $input
     */
    public function testSecondPuzzle(string $input): void
    {
        echo $this->subject->secondPuzzle($input);
    }

    public function getFirstPuzzleData(): array
    {
        return [
            [
                trim(file_get_contents(__DIR__ . '/FirstPuzzleData.txt')),
            ],
        ];
    }

    public function testGetDifferenceForRow(): void
    {
        $this->assertEquals(8, $this->subject->getDifferenceForRow(['1', '3', '9', '6']));
    }

    /**
     * @dataProvider getFirstPuzzleExample
     *
     * @param array $input
     */
    public function testFirstCalculateChecksum(array $input): void
    {
        $this->assertEquals(18, $this->subject->calculateDifferenceChecksum($input));
    }

    public function testReadData(): void
    {
        $this->assertEquals([
            ['1', '3'],
            ['12345', '1234'],
        ], $this->subject->readFile(__DIR__ . '/FirstPuzzleDataExample.txt'));
    }

    public function testIsEvenlyDividable(): void
    {
        $this->assertEquals(true, $this->subject->isEvenlyDividable(4, 2));
        $this->assertEquals(false, $this->subject->isEvenlyDividable(1, 5));
    }

    /**
     * @dataProvider getSecondPuzzleExample
     *
     * @param array $input
     * @param int $result
     */
    public function testGetEvenDivisionResult(array $input, int $result): void
    {
        $this->assertEquals($result, $this->subject->getEvenDivisionResult($input));
    }

    public function getSecondPuzzleData(): array
    {
        return $this->getFirstPuzzleData();
    }

    public function getFirstPuzzleExample(): array
    {
        return [
            [
                [
                    ['5', '1', '9', '5'],
                    ['7', '5', '3'],
                    ['2', '4', '6', '8'],
                ],
            ],
        ];
    }

    public function getSecondPuzzleExample(): array
    {
        return [
            [
                ['5', '9', '2', '8'],
                4,
            ],
            [
                ['9', '4', '7', '3'],
                3,
            ],
            [
                ['3', '8', '6', '5'],
                2,
            ],
        ];
    }
}
