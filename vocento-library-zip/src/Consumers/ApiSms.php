<?php
namespace League\Consumers;

class ApiSms 
{
    private $url = "https://sms-service/";
    private $phone;
    
    public function __construct($phone) {
        $this->phone = $phone;
    }
    
    public function notify()
    {
        //llama al servicio
        //envia el aviso
    }
}

