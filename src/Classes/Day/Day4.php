<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;

class Day4 implements Day
{
    public function firstPuzzle(string $input): int
    {
        $passphrasesValid = 0;

        $passphrases = explode(PHP_EOL, $input);

        foreach ($passphrases as $passphrase) {
            if (!empty($passphrase) && $this->checkPassphraseForDuplicates($passphrase)) {
                $passphrasesValid++;
            }
        }

        return $passphrasesValid;
    }

    public function secondPuzzle(string $input): int
    {
        $passphrasesValid = 0;

        $passphrases = explode(PHP_EOL, $input);

        foreach ($passphrases as $passphrase) {
            if (!empty($passphrase) && $this->checkPassphraseForAnagrams($passphrase)) {
                $passphrasesValid++;
            }
        }

        return $passphrasesValid;
    }

    public function checkPassphraseForDuplicates(string $passphrase): bool
    {
        $bits = explode(' ', trim($passphrase));

        return \count($bits) === \count(array_unique($bits));
    }

    public function checkPassphraseForAnagrams(string $passphrase): bool
    {
        $bits = explode(' ', trim($passphrase));

        foreach ($bits as &$bit) {
            $bit = $this->sortBit($bit);
        }

        return \count($bits) === \count(array_unique($bits));
    }

    private function sortBit(string $bit): string
    {
        $bitArray = str_split($bit);
        sort($bitArray);

        return implode('', $bitArray);
    }
}
