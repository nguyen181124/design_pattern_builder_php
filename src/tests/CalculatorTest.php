<?php

use PHPUnit\Framework\TestCase;
use Nguyen\DesignPatterns\Calculator;

final class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator(18, 6);
    }

    public function testAdd()
    {
        $this->assertSame(24, $this->calculator->add());
    }

    public function testSubtract()
    {
        $this->assertSame(12, $this->calculator->subtract());
    }

    public function testMultiply()
    {
        $this->assertSame(108, $this->calculator->multiplication());
    }

    public function testDivide()
    {
        $this->assertSame(3, $this->calculator->division());
    }
}