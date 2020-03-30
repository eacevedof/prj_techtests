<?php
namespace League\Base;

use League\Base\Api;

abstract class Base 
{
    protected $objapi;
    protected $data;
    
    public function __construct()
    {
        $this->objapi = new Api();
    }

    public function get_fixtures()
    {
        return $this->objapi->set_type("fixtures")->get_data();
    }
    
    public function get_match()
    {
        return $this->objapi->set_type("match")->get_data();
    }
    
    
}