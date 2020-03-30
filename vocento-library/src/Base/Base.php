<?php
namespace League\Base;

use League\Base\Api;

abstract class Base 
{
    protected $objapi;
    protected $date;
    protected $data;
    
    public function __construct()
    {
        $this->objapi = new Api();
    }

    protected function get_fixtures()
    {
        return $this->objapi->set_type("fixtures")->get_data();
    }
    
    protected function get_match()
    {
        return $this->objapi->set_type("match")->get_data();
    }
    
    public function get_teams($date="")
    {
        if(!$date) $date = $this->date;
        return $this->data[$date]["teams"];
    }    
    
    public function get_location($date="") 
    {
        if(!$date) $date = $this->date;
        return $this->data[$date]["location"];
    }    
    
    public function get_kickoff_time($date="") 
    {
        if(!$date) $date = $this->date;
        return $this->data[$date]["kikcoff"];
    }

    public function get_result($date="") 
    {
        $status = $this->get_status($date);
        if(in_array($status,["started","finished"]))        
            return $this->data["result"];
        return null;
    }

    public function get_status($date="") 
    {
        if(!$date) $date = $this->date;        
        return $this->data[$date]["status"];
    }    
}