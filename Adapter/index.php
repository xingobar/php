<?php

interface IExchangeRate{
    public function calculateExchangeRate($dollar);
}

class NtDollarCalcuate implements IExchangeRate{
    public function calculateExchangeRate($dollar){
        return $dollar;
    }
}

class AmericanDollarCalculate{  
    public $rate = 1;

    public function calculateExchangeRate($dollar){
        $dollar *= $this->rate;
        return $dollar;
    }
}

class Company{
    public function transaction(IExchangeRate $calculator){
        echo $calculator->calculateExchangeRate(30);
    }
}

class AmericanDollarAdapter implements IExchangeRate
{
    private $americanCalculator;

    public function __construct(AmericanDollarCalculate $americanCalculator){
        $this->americanCalculator = $americanCalculator;
        $this->americanCalculator->rate = 30;
    }

    public function calculateExchangeRate($dollar){
        return $this->americanCalculator->calculateExchangeRate($dollar);
    }
}

$company = new Company();
echo 'NT dollars : ' ;
echo $company->transaction(new NtDollarCalcuate());
echo '<br/>';
echo 'dollars : ' ;
echo $company->transaction(new AmericanDollarAdapter(new AmericanDollarCalculate));
?>