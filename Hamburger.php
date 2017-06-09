<?php

include_once('Food.php');
class Hamburger
{

    public function prepareIngredient()
    {
        echo "準備漢堡所需食材";
    }

    public function cooking()
    {
        echo "製作漢堡中...";
    }

    public function serve()
    {
        echo "漢堡上餐中";
    }
}

?>