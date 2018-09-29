<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day14;

use PharIo\Version\Version;
use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day14\Disk;
use Sventendo\AdventOfCode2017\Day\Day14\Row;
use Sventendo\AdventOfCode2017\Day\Day14\Vector;

class DiskTest extends TestCase
{
    /**
     * @var Disk
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Disk();
    }

    public function testConvertToBinary(): void
    {
        $this->assertEquals('1010000011000010000000010111', $this->subject->convertToBinary('a0c2017'));
    }

    public function testRowValues(): void
    {
        $this->subject->setSalt('flqrgnkx');
        $this->subject->generateRows();

        $values = [
            '11010100',
            '01010101',
            '00001010',
            '10101101',
            '01101000',
            '11001001',
            '01000100',
            '11010110',
        ];

        foreach ($values as $rowIndex => $value) {
            $this->assertEquals($value, substr($this->subject->getRow($rowIndex)->getValueString(), 0, 8));
        }
    }

    public function testGetFirstValueWithNoGroup(): void
    {
        $rows = [
            new Row(0, '000'),
            new Row(1, '001'),
            new Row(2, '000'),
        ];

        $this->subject->setRows($rows);
        $this->assertEquals(new Vector(2, 1), $this->subject->getFirstSquareWithNoGroup());
    }

    public function testCountUsedSquares(): void
    {
        $rows = [
            new Row(0, '000'),
            new Row(1, '001'),
            new Row(2, '011'),
        ];

        $this->subject->setRows($rows);

        $this->assertEquals(3, $this->subject->countUsedSquares());
    }

    public function testHasAdjacentSquare(): void
    {
        $rows = [
            new Row(0, '000'),
            new Row(1, '001'),
            new Row(2, '001'),
        ];

        $this->subject->setRows($rows);

        $bottomLeftSquare = new Vector(0, 2);

        $this->assertEquals(true, $this->subject->hasAdjacentSquare($bottomLeftSquare, Disk::VALUE_RIGHT));
        $this->assertEquals(false, $this->subject->hasAdjacentSquare($bottomLeftSquare, Disk::VALUE_DOWN));
        $this->assertEquals(false, $this->subject->hasAdjacentSquare($bottomLeftSquare, Disk::VALUE_LEFT));
        $this->assertEquals(true, $this->subject->hasAdjacentSquare($bottomLeftSquare, Disk::VALUE_UP));

        $middleSquare = new Vector(1, 1);
        $this->assertEquals(true, $this->subject->hasAdjacentSquare($middleSquare, Disk::VALUE_DOWN));
        $this->assertEquals(true, $this->subject->hasAdjacentSquare($middleSquare, Disk::VALUE_LEFT));
    }

    public function testInfectValues()
    {
        $rows = [
            new Row(0, '1100'),
            new Row(1, '0110'),
            new Row(2, '0010'),
            new Row(3, '1110'),
        ];

        $this->subject->setRows($rows);

        $this->subject->setDebug(true);
        $this->subject->parseGroups();
    }
}
