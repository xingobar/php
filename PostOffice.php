<?php

include_once('ILogistics.php');
class PostOffice implements ILogistics
{

    public function calculateFee($weight)
    {
        return 70 * $weight * 20;
    }
}

?>