<?php

/////////////////////////////////
// animals skills
interface Iwalkable {

    public function walk(): void;
}

interface Ieatable {

    public function eat(string $someFood): void;
}

interface Imeowable {

    public function meow(): void;
}

interface Irunable {

    public function run(): void;
}

interface Iwufable {

    public function wuf(): void;
}

interface Ibiteable {

    public function bite(string $param): void;
}

interface Iflyable {

    public function fly(): void;
}

interface Itweetable {

    public function tweet(): void;
}

interface Ipipable {

    public function pip(): void;
}

////////////////////////////////////////////////
// animal tree 1 level
interface Ianimal extends Iwalkable, Ieatable {

    public function getName(): string;
}
