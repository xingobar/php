<?php

include_once('ChefFactory.php');

class Restaurant
{
    public function order($meal)
    {
        $chef = ChefFactory::hireChef($meal);
        $chef->prepareIngredient();
        $chef->cooking();
        $chef->serve();
    }
}

?>