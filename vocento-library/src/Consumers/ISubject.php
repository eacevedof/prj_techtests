<?php
namespace League\Consumers;

interface ISubject 
{
    //subscribe
    public function add_observer(IObserver $observer);

    public function remove_observer(IObserver $observer);

    public function notify_observers();
    
}//IfSubject