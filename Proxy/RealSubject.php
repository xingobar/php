<?php
include_once('./IHandler.php');

class RealSubject implements IHandler{

    public function request(){

        $response = <<<REQUEST
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='utf-8'/>
            </head>
            <body>
                <h1>login success</h1>
            </body>
        </html>
REQUEST;
        echo $response;
    }
}
?>