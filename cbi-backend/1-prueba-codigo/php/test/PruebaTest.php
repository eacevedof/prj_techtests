<?php

namespace Cbi\Tests;
use \PHPUnit\Framework\TestCase;
use App\BoardState;

/**
 *
 */
class PruebaTest extends TestCase
{
    const NO_RESUELTO = -1;
    const GANADO_X = 1;
    const GANADO_O = 2;
    const EMPATE = 0;
    
    private function _get_board($case)
    {
        $boards["NO_RESUELTO_INICIO"] = [
            [0,0,0],
            [0,0,0],
            [0,0,0]
        ];        
        $boards["NO_RESUELTO"] = [
            [0,0,1],
            [0,1,2],
            [2,1,0]
        ];
        $boards["GANA_X_VERTICAL"] = [
            [1,1,2],
            [0,1,2],
            [2,1,0]
        ];  
        $boards["GANA_O_VERTICAL"] = [
            [1,2,1],
            [0,2,2],
            [2,2,0]
        ]; 
        
        $boards["EMPATE"] = [
            [1,2,1],
            [1,1,2],
            [2,1,2]
        ];    
        $boards["GANA_X_DIAGONAL_2"] = [
            [1,2,1],
            [2,1,2],
            [1,1,2]
        ];  
        $boards["GANA_O_DIAGONAL_1"] = [
            [2,1,1],
            [2,2,1],
            [2,1,2]
        ];              
        return $boards[$case];
    }// _get_board($case)


    public function test_no_resuelto_inicio()
    {
        $board = $this->_get_board("NO_RESUELTO_INICIO");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::NO_RESUELTO);
    }
    
    
    public function test_no_resuelto()
    {
        $board = $this->_get_board("NO_RESUELTO");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::NO_RESUELTO);
    }
    
    public function test_gana_x_vertical()
    {
        $board = $this->_get_board("GANA_X_VERTICAL");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::GANADO_X);
    }
    
    public function test_gana_o_vertical()
    {
        $board = $this->_get_board("GANA_O_VERTICAL");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::GANADO_O);
    }    
    
    public function test_empate()
    {
        $board = $this->_get_board("EMPATE");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::EMPATE);
    }
    
    public function test_gana_x_diagonal2()
    {
        $board = $this->_get_board("GANA_X_DIAGONAL_2");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::GANADO_X);
    }

    public function test_gana_o_diagonal1()
    {
        $board = $this->_get_board("GANA_O_DIAGONAL_1");
        $status = (new BoardState($board))->get_status();
        $this->assertEquals($status, self::GANADO_O);
    }    
    
}
