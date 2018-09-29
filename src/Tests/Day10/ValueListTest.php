<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Tests\Day\Day10;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day10\ValueList;

class ValueListTest extends TestCase
{
    /**
     * @var ValueList
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new ValueList();
    }

    /**
     * @dataProvider getGetSublistExamples
     *
     * @param int $position
     * @param int $length
     * @param array $sublist
     */
    public function testGetSublist(int $position, int $length, array $sublist): void
    {
        $this->subject->setValues(range(0, 4));
        $this->subject->setPosition($position);
        $this->assertEquals($sublist, $this->subject->getSublist($length));
    }

    /**
     * @dataProvider getReverseSublistExamples
     *
     * @param int $position
     * @param int $length
     * @param array $values
     */
    public function testReverseSublist(int $position, int $length, array $values): void
    {
        $this->subject->setValues(range(0, 4));
        $this->subject->setPosition($position);
        $this->subject->reverseSublist($length);
        $this->assertEquals($values, $this->subject->getValues());
    }

    /**
     * @dataProvider getGetDenseHashChecksumExamples
     *
     * @param string $input
     * @param string $checksum
     */
    public function testGetDenseHashChecksum(string $input, string $checksum): void
    {
        $this->subject->setSequenceFromString($input, [17, 31, 73, 47, 23]);
        $this->assertEquals($checksum, $this->subject->getDenseHashChecksum());
    }

    public function getGetSublistExamples(): array
    {
        return [
            [0, 3, [0, 1, 2]],
            [4, 1, [4]],
            [4, 3, [4, 0, 1]],
        ];
    }

    public function getReverseSublistExamples(): array
    {
        return [
            [0, 3, [2, 1, 0, 3, 4]],
            [4, 3, [0, 4, 2, 3, 1]],
            [2, 5, [3, 2, 1, 0, 4]],
        ];
    }

    public function getGetDenseHashChecksumExamples(): array
    {
        return [
            ['', 'a2582a3a0e66e6e86e3812dcb672a272'],
            ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'],
            ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'],
            ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'],
        ];
    }

}
