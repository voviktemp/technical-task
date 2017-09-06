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

//////////////////////
// animal tree 2 level
interface Ibird extends Ianimal, Iflyable {
    
}

interface Iflightless extends Ianimal, Irunable {
    
}

//////////////////////
// animal tree 3 level

interface Isparrow extends Ibird, Itweetable {
    
}

interface Icat extends Iflightless, Imeowable {
    
}

interface Idog extends Iflightless, Iwufable, Ibiteable {
    
}

interface Irat extends Iflightless, Ipipable {
    
}

// animal factory
interface IAnimalFactory {

    public static function build(string $type, string $name): Ianimal;
}

///////////////////////////////////////////////
// release base animal functions
abstract class AbstractAnimal implements Ianimal {

    protected $name;
    private $separator = "<br>";

    public function __construct($name) {
        $this->setName($name);
    }

    public function eat(string $someFood): void {
        $this->print_on_screen($this->getName() . ' eating ' . $someFood);
    }

    public function walk(): void {
        $this->print_on_screen($this->getName() . ' walking');
    }

    public function getName(): string {
        return $this->name;
    }

    private function setName($name) {
        $this->name = $name;
    }

    protected function print_on_screen(string $str): void {
        echo $str . $this->separator;
    }

}

abstract class AbstractFlightlessAnimal extends AbstractAnimal implements Iflightless {

    public function run(): void {
        $this->print_on_screen($this->getName() . " runing");
    }

}

abstract class AbstractFlyingAnimal extends AbstractAnimal implements Ibird {

    public function fly(): void {
        $this->print_on_screen($this->getName() . " Fly");
    }

}

///////////////////////////////////////////////////////
// cat
class CatAnimal extends AbstractFlightlessAnimal implements Icat {

    public function meow(): void {
        $this->print_on_screen($this->getName() . " meow");
    }

}

// dog
class DogAnimal extends AbstractFlightlessAnimal implements Idog {

    public function bite(string $param): void {
        $this->print_on_screen($this->getName() . " has bitten " . $param);
    }

    public function wuf(): void {
        $this->print_on_screen($this->getName() . " wuf");
    }

}

class RatAnimal extends AbstractFlightlessAnimal implements Irat {

    public function pip(): void {
        $this->print_on_screen($this->getName() . " pip");
    }

}

// parrot sparrow, can copy other animals
class SparrowAnimal extends ABstractFlyingAnimal implements Isparrow, Ipipable, Iwufable {

    public function tweet(): void {
        $this->print_on_screen($this->getName() . " tweet");
    }

    public function pip(): void {
        $this->print_on_screen("pip!!! I'am 'pipable' sparrow, my name is " . $this->getName() . "! I learned this from my friend, the rat...");
    }

    public function wuf(): void {
        $this->print_on_screen("WUF!!! I'am 'pipable' sparrow, my name is " . $this->getName() . "! I learned this from my friend, the dog...");
    }

}

class AnimalFactory implements IAnimalFactory {

    public static function build(string $type, string $name): Ianimal {
        $className = ucfirst(strtolower($type)) . "Animal";
        if (class_exists($className)) {
            return new $className($name);
        } else {
            return new Exception("Wow, I odn't now this animal!");
        }
    }

}
