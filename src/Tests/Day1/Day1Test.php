<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day1;

class Day1Test extends TestCase
{
    /**
     * @var Day1
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Day1();
    }

    /**
     * @dataProvider firstExampleProvider
     *
     * @param int $input
     * @param int $expected
     */
    public function testFirstExamples(int $input, int $expected): void
    {
        $this->assertEquals($expected, $this->subject->firstPuzzle($input));
    }

    /**
     * @dataProvider secondExampleProvider
     *
     * @param int $input
     * @param int $expected
     */
    public function testSecondExamples(int $input, int $expected): void
    {
        $this->assertEquals($expected, $this->subject->secondPuzzle($input));
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

    public function testNumbersShifted(): void
    {
        $this->assertEquals(['3', '4', '1', '2'], $this->subject->getNumbersShifted(['1', '2', '3', '4'], 2));
    }

    public function firstExampleProvider(): array
    {
        return [
            ['1122', 3],
            ['1111', 4],
            ['1234', 0],
            ['91212129', 9],
        ];
    }

    public function getFirstPuzzleData(): array
    {
        return [
            [
                trim(file_get_contents(__DIR__ . '/Day1FirstPuzzleData.txt')),
            ],
        ];
    }

    public function secondExampleProvider(): array
    {
        return [
            ['1212', 6],
            ['1221', 0],
            ['123425', 4],
            ['123123', 12],
            ['12131415', 4],
        ];
    }

    public function getSecondPuzzleData(): array
    {
        return $this->getFirstPuzzleData();
    }
}
