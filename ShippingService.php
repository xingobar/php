<?php

include_once('ILogistics.php');
include_once('LogisiticsFactory.php');
class ShippingService
{
    private $logistics;

    public function __construct(ILogistics $logistics)
    {
        $this->logistics = $logistics;
    }

    public function calculateFee($weight)
    {
        // $logistics = LogisticsFactory::create($companyName);
        // return $logistics->calculateFee($weight);
        return $this->logistics->calculateFee($weight);
    }
}


?>