<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day4;

class Day4Test extends TestCase
{
    /**
     * @var Day4
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Day4();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        $content = $this->getPuzzleData();

        echo $this->subject->firstPuzzle($content);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle(): void
    {
        $content = $this->getPuzzleData();

        echo $this->subject->secondPuzzle($content);
    }

    /**
     * @dataProvider getFirstPuzzleExamples
     *
     * @param string $passphrase
     * @param bool $valid
     */
    public function testFirstPuzzleExamples(string $passphrase, bool $valid): void
    {
        $this->assertSame($this->subject->checkPassphraseForDuplicates($passphrase), $valid);
    }

    public function getFirstPuzzleExamples(): array
    {
        return [
            ['aa bb cc dd ee', true],
            ['aa bb cc dd aa', false],
            ['aa bb cc dd aaa', true],
        ];
    }

    private function getPuzzleData(): string
    {
        return trim(file_get_contents(__DIR__ . '/PuzzleData.txt'));
    }

}
