<?php

abstract class Animal {
    protected string $kind;
    protected string $name;
    protected int $speed;
    protected array $sound;

    public function speak() {
        return "$this->kind named $this->name said: " . $this->sound[array_rand($this->sound)];
    }
}

class Cow extends Animal {
    public function __construct(string $name, int $speed, string ... $sound) {
        $this->name = $name;
        $this->kind = get_class($this);
        $this->speed = $speed;
        $this->sound = $sound;
    }
}

print_r(
    (new Cow('Gertie', 500, 'maw', 'maow'))->speak()
);