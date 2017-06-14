<?php
interface ILion{
    public function roar();
}

class WhiteLion implements ILion{
    public function roar(){
        echo 'meow~~~';
    }
}

class BlackLion implements ILion{
    public function roar(){
        echo 'wang~~~~';
    }
}

class Hunter{
   public function hunt(ILion $animal){
       $animal->roar();
   }
}

class Dog{
    public function bark(){
        echo 'moo~~~';
    }
}

class DogAdapter implements ILion{

    private $dog;

    public function __construct(Dog $dog){
        $this->dog = $dog;
    }
    public function roar(){
        echo $this->dog->bark();
    }
}

$hunter = new Hunter();
$hunter->hunt(new WhiteLion());
$hunter->hunt(new BlackLion());
$dog = new Dog();
$hunter->hunt(new DogAdapter($dog));
?>