<?php

namespace Sventendo\AdventOfCode2017\Day\Day8;

class Command
{
    public const OPERATOR_INCREASE = 'inc';
    public const OPERATOR_DECREASE = 'dec';

    /**
     * @var string
     */
    private $targetName = '';

    /**
     * @var string
     */
    private $operator = self::OPERATOR_INCREASE;

    /**
     * @var int
     */
    private $operationValue = 0;

    /**
     * @var Condition
     */
    private $condition;

    public function getRegisterName(): string
    {
        return $this->targetName;
    }

    public function setTargetName(string $targetName): void
    {
        $this->targetName = $targetName;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function setOperator(string $operator): void
    {
        $this->operator = $operator;
    }

    public function getOperationValue(): int
    {
        return $this->operationValue;
    }

    public function setOperationValue(int $operationValue): void
    {
        $this->operationValue = $operationValue;
    }

    public function getCondition(): Condition
    {
        return $this->condition;
    }

    public function setCondition(Condition $condition): void
    {
        $this->condition = $condition;
    }

}
