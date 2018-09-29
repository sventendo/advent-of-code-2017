<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day9\Parser;

class ParserTest extends TestCase
{
    /**
     * @var Parser
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Parser();
    }

    /**
     * @dataProvider getIgnoredCharactersExamples
     * @param string $input
     * @param string $output
     */
    public function testRemoveIgnoredCharacters(string $input, string $output): void
    {
        $this->subject->setString($input);
        $this->subject->removeIgnoredCharacters();

        $this->assertEquals($output, $this->subject->getString());
    }

    /**
     * @dataProvider getGarbageExamples
     * @param string $input
     */
    public function testRemoveGarbage(string $input): void
    {
        $this->subject->setString($input);
        $this->subject->removeGarbage();

        $this->assertEquals('', $this->subject->getString());
    }

    /**
     * @dataProvider getCountGroupsExamples
     * @param string $input
     * @param int $output
     */
    public function testCountGroups(string $input, int $output): void
    {
        $this->subject->setString($input);
        $this->subject->removeGarbage();
        $this->subject->countGroups();

        $this->assertEquals($output, $this->subject->getGroups());
    }

    /**
     * @dataProvider getCalculateGroupsValueExamples
     * @param string $input
     * @param int $value
     */
    public function testCalculateGroupsValue(string $input, int $value): void
    {
        $this->subject->setString($input);
        $this->subject->removeGarbage();
        $this->subject->calculateGroupsValue();

        $this->assertEquals($value, $this->subject->getGroupsValue());
    }

    public function getIgnoredCharactersExamples(): array
    {
        return [
            ['<{!>}>', '<{}>'],
            ['<!!>', '<>'],
            ['<!!!>>', '<>'],
        ];
    }

    public function getGarbageExamples(): array
    {
        return [
            ['<>'],
            ['<random characters>'],
            ['<1, 2>'],
            ['<<<<>'],
            ['<{!>}>'],
            ['<!!>'],
            ['<!!!>>'],
            ['<{o"i!a,<{i<a>'],
        ];
    }

    public function getCountGroupsExamples(): array
    {
        return [
            // ['{}', 1],
            // ['{{{}}}', 3],
            ['{{},{}}', 3],
            ['{{{},{},{{}}}}', 6],
            ['{<{},{},{{}}>}', 1],
            ['{<a>,<a>,<a>,<a>}', 1],
            ['{{<a>},{<a>},{<a>},{<a>}}', 5],
            ['{{<!>},{<!>},{<!>},{<a>}}', 2],
        ];
    }

    public function getCalculateGroupsValueExamples(): array
    {
        return [
            ['{}', 1],
            ['{{{}}}', 6],
            ['{{},{}}', 5],
            ['{{{},{},{{}}}}', 16],
            ['{<a>,<a>,<a>,<a>}', 1],
            ['{{<ab>},{<ab>},{<ab>},{<ab>}}', 9],
            ['{{<!!>},{<!!>},{<!!>},{<!!>}}', 9],
            ['{{<a!>},{<a!>},{<a!>},{<ab>}}', 3],
        ];
    }
}
