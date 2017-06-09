<?php

include_once('Food.php');

class Curry extends Food
{

    public function prepareIngredient()
    {  
        echo "準備食材咖哩所需食材";
    }

    public function cooking()
    {
        echo "烹飪咖哩中";
    }

    public function serve()
    {
        echo "咖哩上餐";
    }
}

?>