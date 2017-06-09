<?php

include_once('Curry.php');
include_once('Hamburger.php');
class ChefFactory
{
    public static function hireChef($meal)
    {
        switch($meal){
            case 'curry':
                return new Curry();
                break;
            case 'sandwitch':
                return new Hamburger();
                break;
        }
    }
}


?>