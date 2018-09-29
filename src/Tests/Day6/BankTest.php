<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day6\Bank;

class BankTest extends TestCase
{
    public function testHighestValue(): void
    {
        $bank = new Bank([1, 2, 3]);

        $this->assertEquals(2, $bank->getHighestPosition());
    }

    /**
     * @dataProvider getBankExamples
     * @param array $before
     * @param array $after
     */
    public function testSpreadValueFromPosition(array $before, array $after): void
    {
        $bank = new Bank($before);

        $bank->spreadValueFromPosition(0);

        $this->assertEquals($after, $bank->getValues());
    }

    public function getBankExamples(): array
    {
        return [
            [
                [1, 2, 3], [0, 3, 3]
            ],
            [
                [3, 2, 1], [1, 3, 2]
            ],
            [
                [8, 0, 0], [2, 3, 3]
            ]
        ];
    }
}
