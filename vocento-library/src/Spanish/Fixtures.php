<?php
namespace League\Spanish;

use League\Base\Base;
use League\Base\ICommon;

/**
 * Gestiona el consumo de datos del SET: "Fixtures Feed"
 */
class Fixtures extends Base implements ICommon
{
    private $teamid;
    
    public function __construct($teamid) 
    {
        //conector api
        parent::__construct();
        $this->teamid = $teamid;
        $this->_load_data();
    }
    
    protected function _load_data()
    {
        //configuro los parámetros de llamada
        $this->objapi->add_param("teamid", $this->teamid);
        //se obtiene todas las fechas en las que participará el equipo
        $this->data = $this->get_fixtures();        
    }

}