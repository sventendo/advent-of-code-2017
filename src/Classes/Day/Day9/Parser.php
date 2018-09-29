<?php

namespace Sventendo\AdventOfCode2017\Day\Day9;

class Parser
{
    /**
     * @var string
     */
    private $string = '';

    /**
     * @var int
     */
    private $groups = 0;

    /**
     * @var int
     */
    private $groupsValue = 0;

    /**
     * @var array
     */
    private $valueArray = [];

    /**
     * @var int
     */
    private $garbageCount = 0;

    public function setString(string $input): void
    {
        $this->string = $input;
    }

    public function getString(): string
    {
        return $this->string;
    }

    public function parse(): void
    {

    }

    public function removeIgnoredCharacters(): void
    {
        $this->string = preg_replace('/\!./', '', $this->string);
    }

    public function removeGarbage(): void
    {
        $this->removeIgnoredCharacters();
        $pattern = '/\<(.*?)\>/';
        preg_match_all($pattern, $this->string, $matches);
        foreach ($matches[1] as $match) {
            $this->garbageCount += \strlen($match);
        }
        $this->string = preg_replace($pattern, '', $this->string);
    }

    public function countGroups(): void
    {
        $this->groups = substr_count($this->getString(), '{');
    }

    public function getGroups(): int
    {
        return $this->groups;
    }

    public function getGroupsValue(): int
    {
        return $this->groupsValue;
    }

    public function calculateGroupsValue(): void
    {
        $this->getValueArray();
        array_map(function ($key, $value) {
            if ($value === 1) {
                $index = $key + 1;
                $groupValue = array_sum(\array_slice($this->valueArray, 0, $index));
                $this->groupsValue += $groupValue;
            }
        }, array_keys($this->valueArray), $this->valueArray);
    }

    private function getValueArray(): void
    {
        $characters = str_split($this->getString());
        $values = array_map(function ($character) {
            switch ($character) {
                case '{':
                    $value = 1;
                    break;
                case '}':
                    $value = -1;
                    break;
                default:
                    $value = 0;
                    break;
            }

            return $value;
        }, $characters);

        $this->valueArray = $values;
    }

    public function getGarbageCount(): int
    {
        return $this->garbageCount;
    }
}
