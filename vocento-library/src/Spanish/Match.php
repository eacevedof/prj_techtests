<?php
namespace League\Spanish;

use League\Base\Base;
use League\Base\ICommon;
use League\Base\IMatch;

/**
 * Gestiona el consumo de datos del SET: "Match Report Feed"
 */
class Match extends Base implements ICommon, IMatch
{
    private $teamid;
    
    /**
     * Con una fecha y un equipo se puede saber los datos del encuentro
     * el equipo adversario, el lugar, los jugadores, etc
     * @param type $date
     * @param type $teamid
     */
    public function __construct($date,$teamid) 
    {
        //conector api
        parent::__construct();
        $this->date = $date;
        $this->teamid = $teamid;
        $this->_load_data();
    }
    
    protected function _load_data()
    {
        $this->objapi->add_param("date", $this->date)->add_param("teamid",$this->teamid);
        $this->data = $this->get_match();        
    }
    
    public function get_players() 
    {
        return $this->data[$this->date][$this->teamid]["players"];
    }

    public function get_score_player() 
    {
        return $this->data[$this->date][$this->teamid]["scorer1"];
    }    

    public function get_score_time() 
    {
        return $this->data[$this->date][$this->teamid]["score_time"];
    }
    
    public function get_player_card($color = "yellow") 
    {
        return $this->data[$this->date][$this->teamid]["cards"][$color]["player"];
    }

    public function get_card_time($color = "yellow") 
    {
        return $this->data[$this->date][$this->teamid]["cards"][$color]["time"];
    }

}