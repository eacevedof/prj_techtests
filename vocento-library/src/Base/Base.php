<?php
namespace League\Base;

use League\Base\Api;

abstract class Base 
{
    protected $objapi;
    
    public function __construct()
    {
        $this->objapi = new Api();
    }

    public function get_fixtures()
    {
        $this->objapi->set_type("fixtures");
                
    }
    
    public function get_match()
    {
        
    }
}