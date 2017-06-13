<?php

interface Food{
    public function prepareIngredient();
    public function cooking();
    public function serve();
}

class Hamburger implements Food{

    public function prepareIngredient(){
        return '準備漢堡食材';
    }
    public function cooking(){
        return '製作漢堡中...';
    }
    public function serve(){
        return '漢堡上餐中....';
    }
}

class Chicken implements Food{
    
    public function prepareIngredient(){
        return '準備雞腿食材...';
    }
    public function cooking(){
        return '製作雞腿中....';
    }
    public function serve(){
        return '雞腿上餐中....';
    }
}

class Restaurant{

    public function order(Food $food){
        echo $food->prepareIngredient() .'<br/>';
        echo $food->cooking() .'<br/>';
        echo $food->serve() . '<br/>';
    }


}

$restaurant = new Restaurant();
$restaurant->order(new Hamburger());
?>