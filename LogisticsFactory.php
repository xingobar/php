<?php
class LogisticsFactory
{

    public static function create(string $companyName)
    {
        switch ($companyName) {
            case 'BlackCat':
                return new BlackCat();
            case 'PostOffice':
                return new PostOffice();
            default:
                throw new Exception('No company exception');
        }
    }
}

?>