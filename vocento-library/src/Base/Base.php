<?php
namespace League\Base;

use League\Base\Api;

abstract class Base 
{
    protected $objapi;
    
    public function __construct(Api $objapi)
    {
        $this->objapi = $objapi;
    }

}