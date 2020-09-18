<?php
namespace Libs\Actions;

use Lig\Db\ComponentMysql;

class Calculadora
{

    private function _print($op, $num1, $num2, $r)
    {
        echo "El resultado de <b>$op</b> $num1 y $num2 es <b>$r</b>.<br/>";
    }

    private function _print_paridad($numero1, $numero2)
    {
        $r1 = $this->par_impar($numero1);
        $r2 = $this->par_impar($numero2);
        echo "El número $numero1 es <b>$r1</b> y el número $numero2 es <b>$r2</b>.<br/>";
    }

    public function sumar($numero1, $numero2)
    {
        $r = $numero1 + $numero2;
        $this->_print("sumar", (string) $numero1, (string) $numero2, (string) $r);
        return $this;
    }

    public function restar($numero1, $numero2){
        $r = $numero1 - $numero2;
        $this->_print("restar", (string) $numero1, (string) $numero2, (string) $r);
        return $this;
    }

    public function multiplicar($numero1, $numero2){
        $r = $numero1 * $numero2;
        $this->_print("multiplicar", (string) $numero1, (string) $numero2, (string) $r);
        return $this;
    }

    public function dividir($numero1, $numero2){
        $r = "error";
        if($numero2 && $numero2!==0) $r = $numero1 / $numero2;

        $this->_print("dividir", (string) $numero1, (string) $numero2, (string) $r);
        return $this;
    }

    private function  _is_par($numero){return ($numero % 2)===0; }

    public function par_impar($numero){
        if($this->_is_par($numero)) return "par";
        return "impar";
    }

    public function get($numero1, $numero2){
        $this->sumar($numero1,$numero2)
            ->restar($numero1,$numero2)
            ->multiplicar($numero1,$numero2)
            ->dividir($numero1,$numero2)
            ->_print_paridad($numero1,$numero2);
    }



}