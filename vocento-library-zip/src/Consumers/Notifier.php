<?php
namespace League\Consumers;

use League\Spanish\Match;

class Notifier implements ISubject
{
    private $observes = [];
    private $date;
    private $teamid;
    
    public function __construct($date,$teamid) 
    {
        $this->date = $date;
        $this->teamid = $teamid;
    }

    public function add_observer(IObserver $observer) 
    {
        $this->observes[] = $observer;
    }

    private function _get_dbresult()
    {
        //aqui se obtendria el resultado del partido de la bd, en tabla con claves (fecha,equipo)
        $result = "";
        return $result;
    }
    
    private function _db_update($ischanged)
    {
        if($ischanged)
        {
            //si no existe fecha,equipo se crea y si existe se actualiza el resultado    
        }
    }
    
    
    public function is_newgoal()
    {
        //aqui habría que comprobar un cambio de estado (goloes), por ejemplo contra una bd 
        //y lo que devuelve la api
        $matchrep = new Match($this->date, $this->teamid);
        $oldresult = $this->_get_dbresult();
        $ischanged = $oldresult !== $matchrep->get_result();
        $this->_db_update($ischanged);
        return $ischanged;
    }
    
    public function notify_observers() 
    {
        if($this->is_newgoal())
            foreach($this->observes as $objobserver)
                $objobserver->update();
    }

    public function remove_observer(IObserver $observer) 
    {
        foreach($this->observes as $i => $obj)
        {
            if($obj->get_number()==$observer->get_number())
                unset($this->observes[$i]);
        }
    }

}

