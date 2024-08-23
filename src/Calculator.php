<?php

namespace Nguyen\DesignPatterns;

class Calculator {
    private int $a;
    private int $b;

    public function __construct(int $a, int $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function add(): int {
        return $this->a + $this->b;
    }

    public function subtract(): int {
        return $this->a - $this->b;
    }

    public function multiplication(): int {
        return $this->a * $this->b;
    }

    public function division() {
        if ($this->b == 0) {
            echo"Ko chia dc cho 0";
        }
        return $this->a / $this->b;
    }
}
