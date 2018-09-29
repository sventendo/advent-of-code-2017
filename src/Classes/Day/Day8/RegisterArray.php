<?php

namespace Sventendo\AdventOfCode2017\Day\Day8;

class RegisterArray
{
    /**
     * @var int[]
     */
    private $registers = [];

    /**
     * @var int
     */
    private $highestValue = 0;

    public function getRegisters(): array
    {
        return $this->registers;
    }

    public function processCommand(string $commandString): void
    {
        $command = $this->parseCommand($commandString);

        if ($this->evalCondition($command->getCondition())) {
            $this->modifyRegister($command);
        }

        $this->updateHighestValue();
    }

    private function parseCommand(string $commandString): Command
    {
        preg_match('/^(\w*)\s(dec|inc)\s(-?\d*)\sif\s(\w*)\s(\S*)\s(-?\d*)/', $commandString, $matches);

        if (\count($matches) < 2) {
            throw new \Exception('Invalid input data.');
        }

        $command = new Command();
        $command->setTargetName($matches[1]);
        $command->setOperator($matches[2]);
        $command->setOperationValue($matches[3]);

        $condition = new Condition();
        $condition->setTargetName($matches[4]);
        $condition->setOperator($matches[5]);
        $condition->setValue($matches[6]);

        $command->setCondition($condition);

        return $command;
    }

    private function evalCondition(Condition $condition): bool
    {
        $targetValue = $this->getRegisterValue($condition->getTargetName());

        $conditionString = 'return ' . $targetValue . $condition->getOperator() . $condition->getValue() . ';';

        return eval($conditionString);
    }

    private function getRegisterValue($registerName): int
    {
        $targetValue = 0;
        if (array_key_exists($registerName, $this->registers)) {
            $targetValue = $this->registers[$registerName];
        }

        return $targetValue;
    }

    private function modifyRegister(Command $command): void
    {
        if ($this->hasValue($command->getRegisterName()) === false) {
            $this->initializeRegister($command->getRegisterName());
        }

        $this->setRegisterValue($command->getRegisterName(), $this->calculateNewValue($command));
    }

    private function initializeRegister($registerName): void
    {
        $this->registers[$registerName] = 0;
    }

    private function hasValue($getRegisterName): bool
    {
        return array_key_exists($getRegisterName, $this->registers);
    }

    /**
     * @param Command $command
     * @return int|mixed
     */
    private function calculateNewValue(Command $command)
    {
        $oldValue = $this->getRegisterValue($command->getRegisterName());

        $newValue = $oldValue;
        if ($command->getOperator() === Command::OPERATOR_INCREASE) {
            $newValue = $oldValue + $command->getOperationValue();
        } elseif ($command->getOperator() === Command::OPERATOR_DECREASE) {
            $newValue = $oldValue - $command->getOperationValue();
        }

        return $newValue;
    }

    private function setRegisterValue(string $registerName, int $value): void
    {
        $this->registers[$registerName] = $value;
    }

    public function getHighestRegister(): string
    {
        return array_search($this->getHighestRegisterValue(), $this->registers, true);
    }

    public function getHighestRegisterValue(): int
    {
        $highestValue = 0;
        if (\count($this->registers) > 0) {
            $highestValue = max($this->registers);
        }

        return $highestValue;
    }

    private function updateHighestValue(): void
    {
        if ($this->getHighestRegisterValue() > $this->highestValue) {
            $this->highestValue = $this->getHighestRegisterValue();
        }
    }

    public function getHighestValue(): int
    {
        return $this->highestValue;
    }
}
