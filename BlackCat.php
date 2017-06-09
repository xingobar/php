<?php
include_once('ILogistics.php');

class BlackCat implements ILogistics
{
    public function calculateFee($weight)
    {
        return 100 * $weight * 10;
    }
}

?>