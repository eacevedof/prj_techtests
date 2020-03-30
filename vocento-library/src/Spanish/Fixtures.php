<?php
namespace League\Spanish;

use League\Base\Base;
use League\Base\ICommon;

class Fixtures extends Base implements ICommon
{
    private $teamid;
    
    public function __construct($teamid) 
    {
        //conector api
        parent::__construct();
        $this->teamid = $teamid;
        
    }
    
    private function _load_raw()
    {
        $this->objapi->add_param("date", $this->date)->add_param("teamid", $this->teamid);
        $this->data = $this->get_fixtures();        
    }
    
    public function get_teams($date)
    {
        return $this->data[$date]["teams"];
    }    
    
    public function get_location() 
    {
        return $this->data[$date]["teams"];
    }    
    
    public function get_datetime() 
    {
        
    }

 

    public function get_result() 
    {
        return $this->data["result"];
    }



}