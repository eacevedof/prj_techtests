<?php
namespace League\Base;

use League\Base\Base;

class Fixtures extends Base
{
    public function __construct()
    {
        parent::__construct(new Api());
    }
    
}