<?php
namespace League\Consumers;

use League\Consumers\ApiSms;


class Phone implements IObserver
{
    private $number;
    
    public function __construct($number) 
    {
        $this->number = $number;
    }
    
    public function update() 
    {
        $sms = new ApiSms($this->number);
        $sms->notify();
    }
    
    public function get_number(){return $this->number;}
    
    public function set_number($number){$this->number = $number; return $this;}
}

