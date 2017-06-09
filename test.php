<?php


$shippingService = new ShippService(LogisticsFactory::create('BlackCat'));
$shippingService->calculateFee(100);

?>