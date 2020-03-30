<?php
namespace App;

final class BoardState
{
    private $board;
    
    const NO_RESUELTO = -1;
    const GANADO_X = 1;
    const GANADO_O = 2;
    const EMPATE = 0;

    public function __construct(array $board=[])
    {
        $this->board = $board;
        //$this->_load_test();
    }
    
//    private function _load_test()
//    {
//        $this->board = [
//            [0,0,1],
//            [0,1,2],
//            [2,1,0]
//        ];
//        $this->board = [
//            [1,1,1],
//            [0,1,2],
//            [2,1,0]
//        ];  
//        $this->board = [
//            [1,2,1],
//            [0,2,2],
//            [2,2,0]
//        ]; 
//        
//        $this->board = [
//            [1,2,1],
//            [1,1,2],
//            [2,1,2]
//        ];    
//        $this->board = [
//            [1,2,1],
//            [2,1,2],
//            [1,1,2]
//        ];  
//        $this->board = [
//            [2,1,1],
//            [2,2,1],
//            [2,1,2]
//        ];          
//        print_r($this->board);        
//    }

    private function _get_column($y)
    {
        $column = [];
        
        foreach($this->board as $x => $arcol)
            $column[] = $arcol[$y];
        
        return $column;
    }
    
    private function  _get_row($x)
    {
        return $this->board[$x];        
    }
    
    
    private function _is_full_vertical($ifind,$y)
    {
        $column = $this->_get_column($y);
        $column = array_unique($column);
        
        if(count($column)>1)
            return false;
        
        if($column[0] !== $ifind)
            return false;
        
        return true;
    }
        
    private function _is_full_horizontal($ifind,$x)
    {
        $row = $this->_get_row($x);
        $row = array_unique($row);
        //print_r($row);        
        if(count($row)>1)
            return false;
        
        if($row[0] !== $ifind)
            return false;
        
        return true;
    }
    
    private function _is_full_diagonal($ifind)
    {
        $diagonal1 = [
            $this->board[0][0],
            $this->board[1][1],
            $this->board[2][2],
        ];
        
        $diagonal2 = [
            $this->board[0][2],
            $this->board[1][1],
            $this->board[2][0],
        ];        
        
        $diagonal[1] = array_unique($diagonal1);
        $diagonal[2] = array_unique($diagonal2);
        
        foreach($diagonal as $arvals)
        {
            if(count($arvals) === 1 && $arvals[0]===$ifind)
                return true;
        }
        
        return false;
        
    }//is_full_diagonal
    
    private function _is_incomplete()
    {
        for($i=0; $i<3; $i++)
        {
            $row = $this->_get_row($i);
            //0: celda vacia
            if(in_array(0,$row))
               return true;
        }
        
        return false;
    }

    private function _is_winner($ifind)
    {
        for($i=0; $i<3; $i++)
        {
            if($this->_is_full_horizontal($ifind, $i))
                return true;
            if($this->_is_full_vertical($ifind, $i))
                return true;
            if($this->_is_full_diagonal($ifind))
                return true;
        }
        return false;
    }
        

    public function get_status()
    {
        if($this->_is_winner(1))
            return self::GANADO_X;
        if($this->_is_winner(2))
            return self::GANADO_O;
        if($this->_is_incomplete())
            return self::NO_RESUELTO;        
        return self::EMPATE;
    }
   
    
}//BoardState

//print_r("no resuelto: -1, ha ganado x=1, gando o=2, ninguno=0\n");
//print_r((new BoardState())->get_status());
