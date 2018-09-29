<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day6;

class Day6Test extends TestCase
{
    /**
     * @var Day6
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day6();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle()
    {
        $this->subject->initializeBank($this->readTestData());
        $this->subject->runBankCycle();

        echo $this->subject->getCyclesRun();
    }

    public function testSecondPuzzle()
    {
        $this->subject->initializeBank($this->readTestData());
        $this->subject->runBankCycle();

        echo $this->subject->getSequenceLength();
    }

    private function readTestData()
    {
        $values = [];
        $rawData = file_get_contents(__DIR__ . '/PuzzleData.txt');
        $valuesRaw = explode("\t", $rawData);
        foreach ($valuesRaw as $valueRaw) {
            if (trim($valueRaw) !== '') {
                $values[] = (int)$valueRaw;
            }
        }

        return $values;
    }
}
